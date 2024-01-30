<?php

namespace backend\controllers;

use backend\models\GelombangPendaftaran;
//use backend\models\GelombangPendaftaranSearch;
use backend\models\JenisTest;
use backend\models\JenisUjian;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

/**
 * GelombangPendaftaranController implements the CRUD actions for GelombangPendaftaran model.
 */
class GelombangPendaftaranController extends Controller
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
     * Lists all GelombangPendaftaran models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = GelombangPendaftaran::find()->with('jenisUjian');

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['gelombang_pendaftaran_id' => SORT_DESC]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GelombangPendaftaran model.
     * @param int $gelombang_pendaftaran_id Gelombang Pendaftaran ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($gelombang_pendaftaran_id)
    {
        $jenisUjian = JenisUjian::find()->asArray()->all();
        return $this->render('view', [
            'model' => $this->findModel($gelombang_pendaftaran_id),
            'jenisUjian' => $jenisUjian,
        ]);
    }

    /**
     * Creates a new GelombangPendaftaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new GelombangPendaftaran();
        $jenisUjian = JenisUjian::find()->asArray()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Ubah format tanggal sebelum menyimpan
                $model->mulai = Yii::$app->formatter->asDate($model->mulai, 'php:Y-m-d');
                $model->berakhir = Yii::$app->formatter->asDate($model->berakhir, 'php:Y-m-d');
                $model->tanggal_ujian = Yii::$app->formatter->asDate($model->tanggal_ujian, 'php:Y-m-d');
                $model->jam_mulai = date('H:i', strtotime($model->jam_mulai));
                $model->jam_selesai = date('H:i', strtotime($model->jam_selesai));
                // Jika ada atribut tanggal lain yang perlu diubah formatnya, lakukan di sini

                if ($model->save()) {
                    return $this->redirect(['view', 'gelombang_pendaftaran_id' => $model->gelombang_pendaftaran_id]);
                } else {
                    Yii::$app->session->setFlash('error', "Tidak dapat menyimpan data: " . implode('<br>', $model->getErrorSummary(true)));
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'jenisUjian' => $jenisUjian,
        ]);
    }


    /**
     * Updates an existing GelombangPendaftaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $gelombang_pendaftaran_id Gelombang Pendaftaran ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($gelombang_pendaftaran_id)
    {
        $model = $this->findModel($gelombang_pendaftaran_id);
        $jenisUjian = JenisUjian::find()->asArray()->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->mulai = Yii::$app->formatter->asDate($model->mulai, 'php:Y-m-d');
            $model->berakhir = Yii::$app->formatter->asDate($model->berakhir, 'php:Y-m-d');
            $model->tanggal_ujian = Yii::$app->formatter->asDate($model->tanggal_ujian, 'php:Y-m-d');
            $model->jam_mulai = date('H:i', strtotime($model->jam_mulai));
            $model->jam_selesai = date('H:i', strtotime($model->jam_selesai));

            // Simpan model setelah konversi tanggal
            if ($model->save()) {
                return $this->redirect(['view', 'gelombang_pendaftaran_id' => $model->gelombang_pendaftaran_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'jenisUjian' => $jenisUjian,
        ]);
    }

    /**
     * Deletes an existing GelombangPendaftaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $gelombang_pendaftaran_id Gelombang Pendaftaran ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($gelombang_pendaftaran_id)
    {
        $this->findModel($gelombang_pendaftaran_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GelombangPendaftaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $gelombang_pendaftaran_id Gelombang Pendaftaran ID
     * @return GelombangPendaftaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($gelombang_pendaftaran_id)
    {
        if (($model = GelombangPendaftaran::findOne(['gelombang_pendaftaran_id' => $gelombang_pendaftaran_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
