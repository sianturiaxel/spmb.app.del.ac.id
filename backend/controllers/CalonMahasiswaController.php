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
                    return $this->render('view', ['model' => $model]);
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


    // public function actionView($calon_mahasiswa_id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($calon_mahasiswa_id),
    //     ]);
    // }

    // public function actionCreate()
    // {
    //     $model = new CalonMahasiswa();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'calon_mahasiswa_id' => $model->calon_mahasiswa_id]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    // public function actionUpdate($calon_mahasiswa_id)
    // {
    //     $model = $this->findModel($calon_mahasiswa_id);

    //     if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'calon_mahasiswa_id' => $model->calon_mahasiswa_id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

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
        // var_dump($kecamatan);
        // die();

        try {
            $calon_mahasiswa_id = $security->decryptByPassword(base64_decode($calon_mahasiswa_id), $secretKey);
            $model = $this->findModel($calon_mahasiswa_id);

            if ($this->request->isPost) {
                Yii::info("Data POST: " . print_r(Yii::$app->request->post(), true), __METHOD__);
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
                'golonganDarah' => $golonganDarah

            ]);
        } catch (\Exception $e) {
            Yii::error("Exception: " . $e->getMessage(), __METHOD__);
            throw new InvalidParamException('Parameter tidak valid: ' . $e->getMessage());
        }
    }



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
