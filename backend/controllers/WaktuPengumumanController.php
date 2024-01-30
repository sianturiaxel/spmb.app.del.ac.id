<?php

namespace backend\controllers;

use backend\models\WaktuPengumuman;
use backend\models\WaktuPengumumanSearch;
use backend\models\GelombangPendaftaran;
use backend\models\JenisTest;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;


/**
 * WaktuPengumumanController implements the CRUD actions for WaktuPengumuman model.
 */
class WaktuPengumumanController extends Controller
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
     * Lists all WaktuPengumuman models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => WaktuPengumuman::find(),
            'sort' => [
                'defaultOrder' => ['waktu_pengumuman_id' => SORT_DESC]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WaktuPengumuman model.
     * @param int $waktu_pengumuman_id Waktu Pengumuman ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($waktu_pengumuman_id)
    {
        $gelombangPendaftaran = GelombangPendaftaran::find()->asArray()->all();
        $jenisTest = JenisTest::find()->asArray()->all();

        return $this->render('view', [
            'model' => $this->findModel($waktu_pengumuman_id),
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'jenisTest' => $jenisTest,
        ]);
    }

    /**
     * Creates a new WaktuPengumuman model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new WaktuPengumuman();
        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();

        $jenisTest = JenisTest::find()->asArray()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->tanggal_mulai = Yii::$app->formatter->asDate($model->tanggal_mulai, 'php:Y-m-d');
                $model->tanggal_akhir = Yii::$app->formatter->asDate($model->tanggal_akhir, 'php:Y-m-d');

                if ($model->save()) {
                    return $this->redirect(['view', 'waktu_pengumuman_id' => $model->waktu_pengumuman_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'jenisTest' => $jenisTest,
        ]);
    }


    /**
     * Updates an existing WaktuPengumuman model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $waktu_pengumuman_id Waktu Pengumuman ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($waktu_pengumuman_id)
    {
        $model = $this->findModel($waktu_pengumuman_id);
        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();

        $jenisTest = JenisTest::find()->asArray()->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->tanggal_mulai = Yii::$app->formatter->asDate($model->tanggal_mulai, 'php:Y-m-d');
            $model->tanggal_akhir = Yii::$app->formatter->asDate($model->tanggal_akhir, 'php:Y-m-d');

            if ($model->save()) {
                return $this->redirect(['view', 'waktu_pengumuman_id' => $model->waktu_pengumuman_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'jenisTest' => $jenisTest,
        ]);
    }


    /**
     * Deletes an existing WaktuPengumuman model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $waktu_pengumuman_id Waktu Pengumuman ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($waktu_pengumuman_id)
    {
        $this->findModel($waktu_pengumuman_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WaktuPengumuman model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $waktu_pengumuman_id Waktu Pengumuman ID
     * @return WaktuPengumuman the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($waktu_pengumuman_id)
    {
        if (($model = WaktuPengumuman::findOne(['waktu_pengumuman_id' => $waktu_pengumuman_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
