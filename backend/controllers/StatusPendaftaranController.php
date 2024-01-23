<?php

namespace backend\controllers;

use backend\models\StatusPendaftaran;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatusPendaftaranController implements the CRUD actions for StatusPendaftaran model.
 */
class StatusPendaftaranController extends Controller
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
     * Lists all StatusPendaftaran models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StatusPendaftaran::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'status_pendaftaran_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StatusPendaftaran model.
     * @param int $status_pendaftaran_id Status Pendaftaran ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($status_pendaftaran_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($status_pendaftaran_id),
        ]);
    }

    /**
     * Creates a new StatusPendaftaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new StatusPendaftaran();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'status_pendaftaran_id' => $model->status_pendaftaran_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StatusPendaftaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $status_pendaftaran_id Status Pendaftaran ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($status_pendaftaran_id)
    {
        $model = $this->findModel($status_pendaftaran_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'status_pendaftaran_id' => $model->status_pendaftaran_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StatusPendaftaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $status_pendaftaran_id Status Pendaftaran ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($status_pendaftaran_id)
    {
        $this->findModel($status_pendaftaran_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StatusPendaftaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $status_pendaftaran_id Status Pendaftaran ID
     * @return StatusPendaftaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($status_pendaftaran_id)
    {
        if (($model = StatusPendaftaran::findOne(['status_pendaftaran_id' => $status_pendaftaran_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
