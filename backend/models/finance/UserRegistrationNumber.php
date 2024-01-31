<?php

namespace backend\models\finance;

use backend\models\CalonMahasiswa;
use backend\models\GelombangPendaftaran;
use backend\models\Jurusan;
use Exception;
use Yii;

/**
 * This is the model class for table "spmb_t_user_registration_number".
 *
 * @property int $user_registration_number_id
 * @property string $registration_number
 * @property string|null $nim
 * @property int $user_id
 * @property int|null $periode_id
 * @property int $gelombang_pendaftaran_id
 * @property string|null $jenjang
 * @property int|null $program_studi_id
 * @property int $n
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property FincRPeriode $periode
 * @property SpmbTProgramStudi $programStudi
 * @property SysxUser $user
 */
class UserRegistrationNumber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spmb_t_user_registration_number';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_finance');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registration_number', 'user_id', 'gelombang_pendaftaran_id', 'n'], 'required'],
            [['user_id', 'periode_id', 'gelombang_pendaftaran_id', 'program_studi_id', 'n', 'deleted'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['registration_number', 'nim'], 'string', 'max' => 45],
            [['jenjang'], 'string', 'max' => 3],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
            [['periode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Periode::class, 'targetAttribute' => ['periode_id' => 'periode_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserFinance::class, 'targetAttribute' => ['user_id' => 'user_id']],
            [['program_studi_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramStudi::class, 'targetAttribute' => ['program_studi_id' => 'program_studi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_registration_number_id' => 'User Registration Number ID',
            'registration_number' => 'Registration Number',
            'nim' => 'Nim',
            'user_id' => 'User ID',
            'periode_id' => 'Periode ID',
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
            'jenjang' => 'Jenjang',
            'program_studi_id' => 'Program Studi ID',
            'n' => 'N',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    /**
     * Gets query for [[Periode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriode()
    {
        return $this->hasOne(Periode::class, ['periode_id' => 'periode_id']);
    }

    /**
     * Gets query for [[ProgramStudi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramStudi()
    {
        return $this->hasOne(ProgramStudi::class, ['program_studi_id' => 'program_studi_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserFinance::class, ['user_id' => 'user_id']);
    }

    public static function updateDataProdi($jurusan_id, $va){
        $jurusan = Jurusan::find()->where(['jurusan_id' => $jurusan_id])->one();
        $userFinance = UserFinance::find()->where(['virtual_account_number' => $va])->one();
        $userRegNr = UserRegistrationNumber::find()->where(['user_id' => $userFinance->user_id])->one();
        $userRegNr->jenjang = $jurusan->fakultas->alias;
        $userRegNr->program_studi_id = $jurusan_id;
        if($userRegNr->save()){
            return $userRegNr->user_id;
        }
        return false;
    }

    public function cekTagihanPenulang($calon_mahasiswa_id){
        $calonMahasiswa = CalonMahasiswa::find()->where(['calon_mahasiswa_id' => $calon_mahasiswa_id])->one();
        // $va_bank = 'Bank Mandiri';

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
}
