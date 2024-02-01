<?php

namespace backend\controllers;

use Exception;
use backend\models\CalonMahasiswa;
use backend\models\GelombangPendaftaran;
use backend\models\finance\GelombangPendaftaranFinance;
use backend\models\finance\GroupHasGelombang;
use backend\models\finance\InstallmentScheme;
use backend\models\finance\Payment;
use backend\models\finance\PaymentDetailFinance;
use backend\models\finance\PaymentScheme;
use backend\models\finance\PaymentSchemeMapping;
use backend\models\finance\Periode;
use backend\models\finance\ProgramStudi;
use backend\models\finance\UserFinance;
use backend\models\finance\UserHasPaymentScheme;
use backend\models\finance\UserRegistrationNumber;

class PaymentController extends \yii\web\Controller
{
    public function actionCekTagihanPenulang($calon_mahasiswa_id){
        $calonMahasiswa = CalonMahasiswa::find()->where(['calon_mahasiswa_id' => $calon_mahasiswa_id])->one();

        $gelombangPendaftaran = GelombangPendaftaran::find()->where(['gelombang_pendaftaran_id' => $calonMahasiswa->pendaftar->gelombang_pendaftaran_id])->one();
        $gelombang_pendaftaran_id = $gelombangPendaftaran->gelombang_pendaftaran_id;
        
        $user = new UserFinance();
    	$connection = $user::getDb();        

        $userRegistrationNumber = UserRegistrationNumber::find()->where(['registration_number' => $calonMahasiswa->pendaftar->getKodePendaftaran(), 'deleted' => 0])->one();

    	$outerTransaction = $connection->beginTransaction();
    	try {
            $isExistGelombangPendaftaran = $this->_getGelombangPendaftaran($gelombang_pendaftaran_id);
            if (!$isExistGelombangPendaftaran) {
                $outerTransaction->rollback();
                $response['status'] = 'error';
                $response['message'] = 'Gelombang Pendaftaran '.$gelombangPendaftaran->desc.' tidak ditemukan di data Keuangan, silakan sinkronisasi Gelombang Pendaftaran dari SPMB.';
                return json_encode($response);
            }

            $groupGelombang = $this->checkGroupGelombang($gelombang_pendaftaran_id);
            if (!$groupGelombang) {
                $outerTransaction->rollback();
                $response['status'] = 'error';
                $response['message'] = "Gelombang Pendaftaran '".$this->_getGelombangPendaftaran($gelombang_pendaftaran_id)."' belum terdaftar di salah-satu Group Gelombang.";
                return json_encode($response);
            }
            $prodi = ProgramStudi::findOne($calonMahasiswa->jurusan_id);
            if($prodi == null){
                $outerTransaction->rollback();
                $response['status'] = 'error';
                $response['message'] = "Program Studi belum terdaftar di Keuangan, Silakan sinkronisasi";
                return json_encode($response);
            }

    		$paymentSchemeNumber = $this->checkPaymentSchemeNumber($calonMahasiswa->n, $calonMahasiswa->jurusan_id, $groupGelombang);
            if (!$paymentSchemeNumber) {
                $outerTransaction->rollback();
                $response['status'] = 'error';
                $response['message'] = "Payment Scheme untuk N = ".$calonMahasiswa->n.", Program Studi = ".$calonMahasiswa->jurusan->nama.", Gelombang Pendaftaran = ".$this->_getGelombangPendaftaran($gelombangPendaftaran).".";
                return json_encode($response);
            }

    		$userHasPaymentScheme = $this->assignPaymentSchemeToUser($userRegistrationNumber->user_id, $paymentSchemeNumber);
            if (!$userHasPaymentScheme) {
                $outerTransaction->rollback();
                $response['status'] = 'error';
                $response['message'] = "Gagal menetapkan " . $paymentSchemeNumber . " untuk akun keuangan calon mahasiswa.";
                return json_encode($response);
            }

    		$outerTransaction->commit();
            $response['status'] = 'success';
            $response['user_id'] = $userRegistrationNumber->user_id;
    	} catch (Exception $e) {
    		$outerTransaction->rollback();
    	}

        return json_encode($response);
    }

    private function _getGelombangPendaftaran($gelombangPendaftaran){
        $modelGelombangPendaftaran = GelombangPendaftaranFinance::findOne($gelombangPendaftaran);

        if (!is_null($modelGelombangPendaftaran)) {
            return $modelGelombangPendaftaran->name;
        }
        return false;
    }

    public function checkGroupGelombang($gelombangPendaftaran){
        $groupHasGelombang = GroupHasGelombang::find()->where(['gelombang_pendaftaran_id' => $gelombangPendaftaran, 'deleted' => 0])->one();
        if (!is_null($groupHasGelombang)) {
            return $groupHasGelombang->group_gelombang_id;
        }
        return false;
    }

    public function checkPaymentSchemeNumber($n, $programStudi, $groupGelombang){
    	$paymentSchemeMapping = PaymentSchemeMapping::find()->where(['n' => $n, 'group_gelombang_id' => $groupGelombang, 'program_studi_id' => $programStudi])->orderBy(['payment_scheme_mapping_id' => SORT_DESC])->one();

    	if (!is_null($paymentSchemeMapping)) {
    		return $paymentSchemeMapping->payment_scheme_number;
    	}
    	return false;
    }

    public function assignPaymentSchemeToUser($userId, $paymentSchemeNumber){
	    if (!is_null(UserHasPaymentScheme::find()->where(['user_id' => $userId, 'deleted' => 0])->one())) {
	    	$userHasPaymentScheme = UserHasPaymentScheme::find()->where(['user_id' => $userId, 'deleted' => 0])->one();
	    }else{
    		$userHasPaymentScheme = new UserHasPaymentScheme();
            $userHasPaymentScheme->user_id = $userId;
	    }
        $userHasPaymentScheme->payment_scheme_number = $paymentSchemeNumber;
        if ($userHasPaymentScheme->save()) {
            return true;
        }
    	return false;
    }

    public function actionGenerateTagihanPenulang($userId, $calonMahasiswaId){
        $calonMahasiswa = CalonMahasiswa::find()->where(['calon_mahasiswa_id' => $calonMahasiswaId])->one();
        
        $gelombangPendaftaran = GelombangPendaftaran::find()->where(['gelombang_pendaftaran_id' => $calonMahasiswa->pendaftar->gelombang_pendaftaran_id])->one();
        $groupHasGelombang = GroupHasGelombang::find()->where(['gelombang_pendaftaran_id' => $gelombangPendaftaran->gelombang_pendaftaran_id, 'deleted' => 0])->one();
        $paymentSchemeMapping = PaymentSchemeMapping::find()->where(['group_gelombang_id' => $groupHasGelombang->group_gelombang_id, 'program_studi_id' => $calonMahasiswa->jurusan_id])->one();
        $paymentSchemes = PaymentScheme::find()->where(['payment_scheme_number' => $paymentSchemeMapping->payment_scheme_number, 'is_spmb' => 1, 'deleted' => 0])->all();
        
        $periodeId = (new Periode)->getActivePeriodeId();
        $periode = Periode::findOne($periodeId);        
        $user = UserFinance::findOne($userId);

        //create payment
        $monthCode = substr(date("F", mktime(0, 0, 0, $periode->month, 15)), 0, 3);
        $paymentCode = 'PC-'.strtoupper($monthCode.'-'.substr(md5(microtime()),rand(0,26),5)).'-'.$userId.'-'.$periodeId;
        
        $payment = new Payment();
        $payment->payment_code = $paymentCode;
        $payment->payment_status_key = 'REQUEST';
        $payment->user_id = $userId;
        $payment->periode_id = $periodeId;
        $payment->is_fixed = 1;
        $payment->is_spmb = 1;

        if (!$payment->save()) {
            return false;
        }

        foreach($paymentSchemes as $paymentScheme){
            $order = ($paymentScheme->fee->payment_type_key === 'INSTALLMENT') ? 1 : 0;
            $minimum_pay_amount = ($order === 0) ? $paymentScheme->fee->amount : (new InstallmentScheme)->getInstallmentAmount($paymentScheme->fee_id, $order);
            $paymentDetail = new PaymentDetailFinance();
            $paymentDetail->payment_code = $payment->payment_code;
            $paymentDetail->fee_id = $paymentScheme->fee_id;
            $paymentDetail->order = $order;            
            $paymentDetail->minimum_pay_amount = $minimum_pay_amount;
            $paymentDetail->payment_status_key = 'REQUEST';
            $paymentDetail->cash_amount = $paymentScheme->fee->amount;
            $paymentDetail->total_amount_paid = $paymentScheme->fee->amount;
            $paymentDetail->payment_date = date('Y-m-d');
            $paymentDetail->save();
        }

        //UPDATE TOTAL PAYMENT (MINIMUM AND TOTAL FEE)
        $updateTotalFeeAmountPayment = $payment;
        if (!is_null($updateTotalFeeAmountPayment)) {
            $minimumPayment = 0;
            $maxPayment = 0;
            $paymentDetails = PaymentDetailFinance::find()->where(['payment_code' => $payment->payment_code])->all();
            foreach ($paymentDetails as $paymentDetail) {
                $minimumPayment += $paymentDetail->minimum_pay_amount;
                if ($paymentDetail->fee->payment_type_key === 'RECURRENCED') {
                    $maxPayment += $paymentDetail->minimum_pay_amount;
                }else{
                    $maxPayment += $paymentDetail->fee->amount;
                }
            }

            $updateTotalFeeAmountPayment->total_fee_amount = $maxPayment;
            $updateTotalFeeAmountPayment->minimum_pay_amount = $minimumPayment;
            $updateTotalFeeAmountPayment->cash_amount = $minimumPayment;
            $updateTotalFeeAmountPayment->total_amount_paid = $minimumPayment;

            if (!$updateTotalFeeAmountPayment->save()) {
                return false; 
            }
            return $payment;
        }
        return false;
    }
}
