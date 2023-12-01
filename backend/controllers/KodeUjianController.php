<?php

namespace backend\controllers;

use backend\models\KodeUjian;
use backend\models\KodeUjianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KodeUjianController implements the CRUD actions for KodeUjian model.
 */
class KodeUjianController extends Controller
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
     * Lists all KodeUjian models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new KodeUjianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KodeUjian model.
     * @param int $kode_ujian_id Kode Ujian ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($kode_ujian_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($kode_ujian_id),
        ]);
    }

    /**
     * Creates a new KodeUjian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new KodeUjian();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'kode_ujian_id' => $model->kode_ujian_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KodeUjian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $kode_ujian_id Kode Ujian ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($kode_ujian_id)
    {
        $model = $this->findModel($kode_ujian_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'kode_ujian_id' => $model->kode_ujian_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KodeUjian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $kode_ujian_id Kode Ujian ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($kode_ujian_id)
    {
        $this->findModel($kode_ujian_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KodeUjian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $kode_ujian_id Kode Ujian ID
     * @return KodeUjian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($kode_ujian_id)
    {
        if (($model = KodeUjian::findOne(['kode_ujian_id' => $kode_ujian_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
