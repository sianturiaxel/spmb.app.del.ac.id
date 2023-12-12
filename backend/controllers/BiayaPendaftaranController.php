<?php

namespace backend\controllers;

use backend\models\BiayaPendaftaran;
use backend\models\GelombangPendaftaran;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii;


/**
 * BiayaPendaftaranController implements the CRUD actions for BiayaPendaftaran model.
 */
class BiayaPendaftaranController extends Controller
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

    /**
     * Lists all BiayaPendaftaran models.
     *
     * @return string
     */
    // public function actionIndex()
    // {
    //     $searchModel = new BiayaPendaftaranSearch();
    //     $dataProvider = $searchModel->search($this->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => BiayaPendaftaran::find(),

        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single BiayaPendaftaran model.
     * @param int $biaya_pendaftaran_id Biaya Pendaftaran ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionView($biaya_pendaftaran_id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($biaya_pendaftaran_id),
    //     ]);
    // }

    public function actionView($biaya_pendaftaran_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = BiayaPendaftaran::findOne($biaya_pendaftaran_id);
        if ($model) {
            return [
                'gelombang' => $model->gelombang->desc,
                'biaya_daftar' => $model->biaya_daftar
            ];
        } else {
            throw new NotFoundHttpException('Data tidak ditemukan.');
        }
    }

    /**
     * Creates a new BiayaPendaftaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     $model = new BiayaPendaftaran();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['index', 'biaya_pendaftaran_id' => $model->biaya_pendaftaran_id]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }
    public function actionCreate()
    {
        $model = new BiayaPendaftaran();
        // Ambil semua data gelombang pendaftaran untuk ditampilkan di dropdown
        $GelombangPendaftaran = GelombangPendaftaran::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Logika untuk menyimpan data dan set flash message
        }

        // Pastikan untuk mengirim variabel ke view
        return $this->render('create', [
            'model' => $model,
            'GelombangPendaftaran' => $GelombangPendaftaran,
        ]);
    }


    /**
     * Updates an existing BiayaPendaftaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $biaya_pendaftaran_id Biaya Pendaftaran ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($biaya_pendaftaran_id)
    {
        $model = $this->findModel($biaya_pendaftaran_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'biaya_pendaftaran_id' => $model->biaya_pendaftaran_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BiayaPendaftaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $biaya_pendaftaran_id Biaya Pendaftaran ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($biaya_pendaftaran_id)
    {
        $this->findModel($biaya_pendaftaran_id)->delete();

        return $this->redirect(['index']);
    }

    public function formatRupiah($angka)
    {
        return "Rp " . number_format($angka, 2, ',', '.');
    }
    /**
     * Finds the BiayaPendaftaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $biaya_pendaftaran_id Biaya Pendaftaran ID
     * @return BiayaPendaftaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($biaya_pendaftaran_id)
    {
        if (($model = BiayaPendaftaran::findOne(['biaya_pendaftaran_id' => $biaya_pendaftaran_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
