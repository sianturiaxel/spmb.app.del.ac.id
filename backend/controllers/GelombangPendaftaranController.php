<?php

namespace backend\controllers;

use backend\models\GelombangPendaftaran;
use backend\models\GelombangPendaftaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $searchModel = new GelombangPendaftaranSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
        return $this->render('view', [
            'model' => $this->findModel($gelombang_pendaftaran_id),
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

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'gelombang_pendaftaran_id' => $model->gelombang_pendaftaran_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'gelombang_pendaftaran_id' => $model->gelombang_pendaftaran_id]);
        }

        return $this->render('update', [
            'model' => $model,
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
