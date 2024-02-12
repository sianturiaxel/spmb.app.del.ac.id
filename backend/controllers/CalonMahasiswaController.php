<?php

namespace backend\controllers;

use backend\models\CalonMahasiswa;

use backend\models\JenisKelamin;
use backend\models\Kecamatan;
use backend\models\Agama;
use backend\models\Provinsi;
use backend\models\Kabupaten;
use backend\models\JenjangPendidikan;
use backend\models\Pekerjaan;
use backend\models\SekolahDapodik;
use backend\models\MetodePembayaran;
use backend\models\KemampuanBahasa;
use backend\models\StatusPendaftaran;
use backend\models\PaymentDetail;
use backend\models\JalurPendaftaran;
use backend\models\GelombangPendaftaran;
use backend\models\GolonganDarah;
use backend\models\Pendaftar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\html;
use yii\base\Security;
use yii\base\InvalidParamException;
use yii;

/**
 * CalonMahasiswaController implements the CRUD actions for CalonMahasiswa model.
 */
class CalonMahasiswaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
    private function encryptId($id)
    {
        $security = new Security();
        $secretKey = 'YourComplexSecretKey123!';
        return base64_encode($security->encryptByPassword($id, $secretKey));
    }

    public function getEncryptedIdCached($calon_mahasiswa_id)
    {
        $cacheKey = 'encrypted_id_' . $calon_mahasiswa_id;
        $encrypted_id = Yii::$app->cache->get($cacheKey);

        if ($encrypted_id === false) {
            $encrypted_id = $this->encryptId($calon_mahasiswa_id);
            Yii::$app->cache->set($cacheKey, $encrypted_id, 3600);
        }

        return $encrypted_id;
    }


    public function actionDataForDatatables()
    {
        $cacheKeyTotalRecords = 'total_records_key';
        $cacheKeyTotalDisplayRecords = 'total_display_records_key_' . serialize($_GET);
        $queryParams = Yii::$app->request->queryParams;
        $draw = Yii::$app->request->get('draw');
        $start = Yii::$app->request->get('start');
        $length = Yii::$app->request->get('length');
        $query = CalonMahasiswa::find()->joinWith('pendaftar');


        $totalRecords = Yii::$app->cache->get($cacheKeyTotalRecords);
        $totalDisplayRecords = Yii::$app->cache->get($cacheKeyTotalDisplayRecords);
        if ($totalRecords === false || $totalDisplayRecords === false) {
            if (!empty($queryParams['gelombang_pendaftaran_id'])) {
                $query->andWhere(['t_pendaftar.gelombang_pendaftaran_id' => $queryParams['gelombang_pendaftaran_id']]);
            }
            if (isset($queryParams['status_pembayaran']) && $queryParams['status_pembayaran'] !== '') {
                $query->andWhere(['status_pembayaran' => $queryParams['status_pembayaran']]);
            }
            if (!empty($search)) {
                $query->andFilterWhere(['like', 'nama', $search]);
            }
            if ($totalRecords === false) {
                $totalRecords = $query->count();
                Yii::$app->cache->set($cacheKeyTotalRecords, $totalRecords, 3600); // Cache selama 1 jam
            }
            if ($totalDisplayRecords === false) {
                $totalDisplayRecords = $query->count();
                Yii::$app->cache->set($cacheKeyTotalDisplayRecords, $totalDisplayRecords, 3600); // Cache selama 1 jam
            }
        }
        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];
        $no = $start + 1;
        foreach ($data as $calonMahasiswa) {
            $statusPembayaranText = '';
            if ($calonMahasiswa->status_pembayaran == 0) {
                $statusPembayaranText = 'Belum Membayar';
            } elseif ($calonMahasiswa->status_pembayaran == 1) {
                $statusPembayaranText = 'Sudah Membayar ';
            } else {
                $statusPembayaranText = 'Status Tidak Diketahui';
            }
            $encrypted_id = $this->getEncryptedIdCached($calonMahasiswa->calon_mahasiswa_id);
            $actionButtons = Html::a('<i class="fa fa-eye"></i>', ['view', 'calon_mahasiswa_id' => $encrypted_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                . ' ' .
                Html::a('<i class="fas fa-edit"></i>', ['update', 'calon_mahasiswa_id' => $encrypted_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update']);

            $dataArray[] = [
                'no' => $no++,
                'calon_mahasiswa_id' => $calonMahasiswa->calon_mahasiswa_id,
                //'calon_mahasiswa_id' => $this->getEncryptedIdCached($calonMahasiswa->calon_mahasiswa_id),
                'pendaftar_id' => $calonMahasiswa->pendaftar_id,
                'nama' => $calonMahasiswa->nama,
                'nik' => $calonMahasiswa->nik,
                'jalur_pendaftaran' => $calonMahasiswa->jalurPendaftaran ? $calonMahasiswa->jalurPendaftaran->desc : 'Tidak ditemukan',
                'jurusan' => $calonMahasiswa->jurusan ? $calonMahasiswa->jurusan->nama : 'Tidak ditemukan',
                'status_pembayaran' => $statusPembayaranText,
                'action' => $actionButtons,
            ];
        }
        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalDisplayRecords,
            "data" => $dataArray
        ];

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
    }


    public function actionGetGelombangPendaftaran($pendaftar_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $pendaftar = Pendaftar::find()
            ->with(['gelombangPendaftaran'])
            ->where(['pendaftar_id' => $pendaftar_id])
            ->one();

        if ($pendaftar && $pendaftar->gelombangPendaftaran) {
            return [
                'gelombangPendaftaran' => [
                    'id' => $pendaftar->gelombangPendaftaran->gelombang_pendaftaran_id,
                    'deskripsi' => $pendaftar->gelombangPendaftaran->desc
                ]
            ];
        } else {
            return ['gelombangPendaftaran' => null];
        }
    }

    public function actionIndex()
    {
        $jalurPendaftaran = JalurPendaftaran::find()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => CalonMahasiswa::find(),

        ]);

        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'jalurPendaftaran' => $jalurPendaftaran,
            'gelombangPendaftaran' => $gelombangPendaftaran, // Pastikan mengirimkan variabel ini ke view
        ]);
    }

    public function actionView($calon_mahasiswa_id)
    {
        $security = new Security();
        $secretKey = 'YourComplexSecretKey123!';

        try {
            $calon_mahasiswa_id = $security->decryptByPassword(base64_decode($calon_mahasiswa_id), $secretKey);

            if ($calon_mahasiswa_id) {
                $model = CalonMahasiswa::findOne($calon_mahasiswa_id);

                if ($model !== null) {
                    $paymentDetail = $model->paymentDetail;

                    return $this->render('view', [
                        'model' => $model,
                        'paymentDetail' => $paymentDetail,
                    ]);
                } else {
                    throw new NotFoundHttpException('Calon Mahasiswa tidak ditemukan.');
                }
            } else {
                throw new InvalidParamException('Parameter tidak valid.');
            }
        } catch (\Exception $e) {
            Yii::error("Error saat dekripsi: " . $e->getMessage());
            throw new InvalidParamException('Terjadi kesalahan dalam proses dekripsi.');
        }
    }

    public function actionUpdate($calon_mahasiswa_id)
    {
        $security = new Security();
        $secretKey = 'YourComplexSecretKey123!';
        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();
        $jenisKelamin = JenisKelamin::find()->asArray()->all();
        $golonganDarah = GolonganDarah::find()->asArray()->all();
        $agama = Agama::find()->asArray()->all();
        $kecamatan = Kecamatan::find()->asArray()->all();
        $kabupaten = Kabupaten::find()->asArray()->all();
        $provinsi = Provinsi::find()->asArray()->all();
        $kecamatanOrangtua = Kecamatan::find()->asArray()->all();
        $kabupatenOrangtua = Kabupaten::find()->asArray()->all();
        $provinsiOrangtua = Provinsi::find()->asArray()->all();
        $pendidikanAyah = JenjangPendidikan::find()->asArray()->all();
        $pendidikanIbu = JenjangPendidikan::find()->asArray()->all();
        $pekerjaanAyah = Pekerjaan::find()->asArray()->all();
        $pekerjaanIbu = Pekerjaan::find()->asArray()->all();
        $sekolahDapodik = SekolahDapodik::find()->asArray()->all();
        $kemampuanBahasaInggris = KemampuanBahasa::find()->asArray()->all();
        $kemampuanBahasaAsing = KemampuanBahasa::find()->asArray()->all();
        $metodePembayaran = MetodePembayaran::find()->asArray()->all();
        $statusPendaftaran = StatusPendaftaran::find()->asArray()->all();

        try {
            $calon_mahasiswa_id = $security->decryptByPassword(base64_decode($calon_mahasiswa_id), $secretKey);
            $model = $this->findModel($calon_mahasiswa_id);

            $paymentDetail = PaymentDetail::findAll(['calon_mahasiswa_id' => $calon_mahasiswa_id]);
            $paymentDetailData = [];
            foreach ($paymentDetail as $key => $paymentDetailItem) {
                $paymentDetailData['PaymentDetail_' . $key] = $paymentDetailItem->attributes;
            }

            if ($this->request->isPost) {
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    foreach ($paymentDetail as $key => $paymentDetailItem) {
                        $postKey = 'PaymentDetail_' . $key;
                        $paymentDetailItem->load(Yii::$app->request->post($postKey));
                        $paymentDetailItem->save();
                    }

                    $encrypted_id = base64_encode($security->encryptByPassword($model->calon_mahasiswa_id, $secretKey));
                    return $this->redirect(['index', 'calon_mahasiswa_id' => $encrypted_id]);
                } else {
                    Yii::error("Error saat menyimpan: " . print_r($model->getErrors(), true), __METHOD__);
                }
            }

            return $this->render('update', [
                'model' => $model,
                'gelombangPendaftaran' => $gelombangPendaftaran,
                'jenisKelamin' => $jenisKelamin,
                'agama' => $agama,
                'kecamatan' => $kecamatan,
                'kabupaten' => $kabupaten,
                'provinsi' => $provinsi,
                'kecamatanOrangtua' => $kecamatanOrangtua,
                'kabupatenOrangtua' => $kabupatenOrangtua,
                'provinsiOrangtua' => $provinsiOrangtua,
                'pendidikanAyah' => $pendidikanAyah,
                'pendidikanIbu' => $pendidikanIbu,
                'pekerjaanAyah' => $pekerjaanAyah,
                'pekerjaanIbu' => $pekerjaanIbu,
                'sekolahDapodik' => $sekolahDapodik,
                'kemampuanBahasaInggris' => $kemampuanBahasaInggris,
                'kemampuanBahasaAsing' => $kemampuanBahasaAsing,
                'metodePembayaran' => $metodePembayaran,
                'statusPendaftaran' => $statusPendaftaran,
                'golonganDarah' => $golonganDarah,
                'paymentDetail' => $paymentDetail,
                'paymentDetailData' => $paymentDetailData,
            ]);
        } catch (\Exception $e) {
            Yii::error("Exception: " . $e->getMessage(), __METHOD__);
            throw new InvalidParamException('Parameter tidak valid: ' . $e->getMessage());
        }
    }

    public function actionPaymentEdit($payment_detail_id)
    {
        $model = PaymentDetail::findOne($payment_detail_id);

        if (!$model) {
            Yii::error("Payment Detail not found for ID: $payment_detail_id", __METHOD__);
            throw new NotFoundHttpException('Payment Detail not found.');
        }

        $calon_mahasiswa_id = $model->calon_mahasiswa_id;

        if ($this->request->isPost) {
            $postData = Yii::$app->request->post();

            // Load data ke model PaymentDetail
            if ($model->load($postData) && $model->save()) {
                // Set flash message
                Yii::$app->getSession()->setFlash('success', 'Payment Detail successfully updated.');

                // Render partial view untuk ditampilkan dalam modal
                $view = $this->renderAjax('_success_message', [
                    'message' => 'Payment Detail successfully updated.',
                ]);

                // Return partial view sebagai respons AJAX
                return $this->asJson(['success' => true, 'view' => $view]);
            } else {
                Yii::error("Error saat menyimpan: " . print_r($model->getErrors(), true), __METHOD__);
                Yii::$app->getSession()->setFlash('error', 'Failed to update Payment Detail.');

                // Render partial view untuk ditampilkan dalam modal
                $view = $this->renderAjax('_error_message', [
                    'message' => 'Failed to update Payment Detail.',
                ]);

                // Return partial view sebagai respons AJAX
                return $this->asJson(['success' => false, 'view' => $view]);
            }
        }

        return $this->render('payment-edit', [
            'model' => $model,
        ]);
    }




    // public function actionUpdate($calon_mahasiswa_id)
    // {
    //     $security = new Security();
    //     $secretKey = 'YourComplexSecretKey123!';
    //     $gelombangPendaftaran = GelombangPendaftaran::find()
    //         ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
    //         ->all();
    //     $jenisKelamin = JenisKelamin::find()->asArray()->all();
    //     $golonganDarah = GolonganDarah::find()->asArray()->all();
    //     $agama = Agama::find()->asArray()->all();
    //     $kecamatan = Kecamatan::find()->asArray()->all();
    //     $kabupaten = Kabupaten::find()->asArray()->all();
    //     $provinsi = Provinsi::find()->asArray()->all();
    //     $kecamatanOrangtua = Kecamatan::find()->asArray()->all();
    //     $kabupatenOrangtua = Kabupaten::find()->asArray()->all();
    //     $provinsiOrangtua = Provinsi::find()->asArray()->all();
    //     $pendidikanAyah = JenjangPendidikan::find()->asArray()->all();
    //     $pendidikanIbu = JenjangPendidikan::find()->asArray()->all();
    //     $pekerjaanAyah = Pekerjaan::find()->asArray()->all();
    //     $pekerjaanIbu = Pekerjaan::find()->asArray()->all();
    //     $sekolahDapodik = SekolahDapodik::find()->asArray()->all();
    //     $kemampuanBahasaInggris = KemampuanBahasa::find()->asArray()->all();
    //     $kemampuanBahasaAsing = KemampuanBahasa::find()->asArray()->all();
    //     $metodePembayaran = MetodePembayaran::find()->asArray()->all();
    //     $statusPendaftaran = StatusPendaftaran::find()->asArray()->all();
    //     // var_dump($kecamatan);
    //     // die();

    //     try {
    //         $calon_mahasiswa_id = $security->decryptByPassword(base64_decode($calon_mahasiswa_id), $secretKey);
    //         $model = $this->findModel($calon_mahasiswa_id);

    //         if ($this->request->isPost) {
    //             Yii::info("Data POST: " . print_r(Yii::$app->request->post(), true), __METHOD__);
    //             if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //                 $encrypted_id = base64_encode($security->encryptByPassword($model->calon_mahasiswa_id, $secretKey));
    //                 return $this->redirect(['index', 'calon_mahasiswa_id' => $encrypted_id]);
    //             } else {
    //                 Yii::error("Error saat menyimpan: " . print_r($model->getErrors(), true), __METHOD__);
    //             }
    //         }


    //         return $this->render('update', [
    //             'model' => $model,
    //             'gelombangPendaftaran' => $gelombangPendaftaran,
    //             'jenisKelamin' => $jenisKelamin,
    //             'agama' => $agama,
    //             'kecamatan' => $kecamatan,
    //             'kabupaten' => $kabupaten,
    //             'provinsi' => $provinsi,
    //             'kecamatanOrangtua' => $kecamatanOrangtua,
    //             'kabupatenOrangtua' => $kabupatenOrangtua,
    //             'provinsiOrangtua' => $provinsiOrangtua,
    //             'pendidikanAyah' => $pendidikanAyah,
    //             'pendidikanIbu' => $pendidikanIbu,
    //             'pekerjaanAyah' => $pekerjaanAyah,
    //             'pekerjaanIbu' => $pekerjaanIbu,
    //             'sekolahDapodik' => $sekolahDapodik,
    //             'kemampuanBahasaInggris' => $kemampuanBahasaInggris,
    //             'kemampuanBahasaAsing' => $kemampuanBahasaAsing,
    //             'metodePembayaran' => $metodePembayaran,
    //             'statusPendaftaran' => $statusPendaftaran,
    //             'golonganDarah' => $golonganDarah

    //         ]);
    //     } catch (\Exception $e) {
    //         Yii::error("Exception: " . $e->getMessage(), __METHOD__);
    //         throw new InvalidParamException('Parameter tidak valid: ' . $e->getMessage());
    //     }
    // }


    public function actionDelete($calon_mahasiswa_id)
    {
        $this->findModel($calon_mahasiswa_id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($calon_mahasiswa_id)
    {
        if (($model = CalonMahasiswa::findOne(['calon_mahasiswa_id' => $calon_mahasiswa_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
