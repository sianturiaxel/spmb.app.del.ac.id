<?php

namespace backend\controllers;

use backend\models\PindahLokasi;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PindahLokasiController implements the CRUD actions for PindahLokasi model.
 */
class PindahLokasiController extends Controller
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
     * Lists all PindahLokasi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PindahLokasi::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'pindah_lokasi_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PindahLokasi model.
     * @param int $pindah_lokasi_id Pindah Lokasi ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($pindah_lokasi_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($pindah_lokasi_id),
        ]);
    }

    /**
     * Creates a new PindahLokasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PindahLokasi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'pindah_lokasi_id' => $model->pindah_lokasi_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PindahLokasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $pindah_lokasi_id Pindah Lokasi ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($pindah_lokasi_id)
    {
        $model = $this->findModel($pindah_lokasi_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pindah_lokasi_id' => $model->pindah_lokasi_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PindahLokasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $pindah_lokasi_id Pindah Lokasi ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($pindah_lokasi_id)
    {
        $this->findModel($pindah_lokasi_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PindahLokasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $pindah_lokasi_id Pindah Lokasi ID
     * @return PindahLokasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($pindah_lokasi_id)
    {
        if (($model = PindahLokasi::findOne(['pindah_lokasi_id' => $pindah_lokasi_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
