<?php

namespace backend\controllers;

use backend\models\CalonMahasiswa;
use backend\models\JalurPendaftaran;
use backend\models\GelombangPendaftaran;
use backend\models\Pendaftar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\html;
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

    public function actionDataForDatatables()
    {
        $queryParams = Yii::$app->request->queryParams;
        $draw = Yii::$app->request->get('draw');
        $start = Yii::$app->request->get('start');
        $length = Yii::$app->request->get('length');
        $query = CalonMahasiswa::find()->joinWith('pendaftar');


        $totalRecords = $query->count();
        if (!empty($queryParams['gelombang_pendaftaran_id'])) {
            $query->andWhere(['t_pendaftar.gelombang_pendaftaran_id' => $queryParams['gelombang_pendaftaran_id']]);
        }
        if (isset($queryParams['status_pembayaran']) && $queryParams['status_pembayaran'] !== '') {
            $query->andWhere(['status_pembayaran' => $queryParams['status_pembayaran']]);
        }
        if (!empty($search)) {
            $query->andFilterWhere(['like', 'nama', $search]);
        }
        $totalDisplayRecords = $query->count();
        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];

        foreach ($data as $calonMahasiswa) {
            $statusPembayaranText = '';
            if ($calonMahasiswa->status_pembayaran == 0) {
                $statusPembayaranText = 'Belum Membayar';
            } elseif ($calonMahasiswa->status_pembayaran == 1) {
                $statusPembayaranText = 'Sudah Membayar ';
            } else {
                $statusPembayaranText = 'Status Tidak Diketahui';
            }
            $dataArray[] = [
                'no' => $calonMahasiswa->calon_mahasiswa_id,
                'nama' => $calonMahasiswa->nama,
                'nik' => $calonMahasiswa->nik,
                'jalur_pendaftaran' => $calonMahasiswa->namaJalur ? $calonMahasiswa->namaJalur->desc : 'Tidak ditemukan',
                'jurusan' => $calonMahasiswa->jurusan ? $calonMahasiswa->jurusan->nama : 'Tidak ditemukan',
                'status_pembayaran' => $statusPembayaranText,


                'action' =>
                Html::a('<i class="fa fa-eye"></i>', ['view', 'calon_mahasiswa_id' => $calonMahasiswa->calon_mahasiswa_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                    . ' ' .
                    Html::a('<i class="fas fa-edit"></i>', ['update', 'calon_mahasiswa_id' => $calonMahasiswa->calon_mahasiswa_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update']),
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

    /**
     * Lists all CalonMahasiswa models.
     *
     * @return string
     */
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

    /**
     * Displays a single CalonMahasiswa model.
     * @param int $calon_mahasiswa_id Calon Mahasiswa ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($calon_mahasiswa_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($calon_mahasiswa_id),
        ]);
    }

    /**
     * Creates a new CalonMahasiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CalonMahasiswa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'calon_mahasiswa_id' => $model->calon_mahasiswa_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CalonMahasiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $calon_mahasiswa_id Calon Mahasiswa ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($calon_mahasiswa_id)
    {
        $model = $this->findModel($calon_mahasiswa_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'calon_mahasiswa_id' => $model->calon_mahasiswa_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CalonMahasiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $calon_mahasiswa_id Calon Mahasiswa ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($calon_mahasiswa_id)
    {
        $this->findModel($calon_mahasiswa_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CalonMahasiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $calon_mahasiswa_id Calon Mahasiswa ID
     * @return CalonMahasiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($calon_mahasiswa_id)
    {
        if (($model = CalonMahasiswa::findOne(['calon_mahasiswa_id' => $calon_mahasiswa_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
