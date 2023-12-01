<?php

namespace backend\Controllers;

use backend\models\SekolahPmdk;
use backend\models\SekolahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SekolahController implements the CRUD actions for SekolahPmdk model.
 */
class SekolahController extends Controller
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
     * Lists all SekolahPmdk models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SekolahSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SekolahPmdk model.
     * @param int $sekolah_pmdk_id Sekolah Pmdk ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sekolah_pmdk_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($sekolah_pmdk_id),
        ]);
    }

    /**
     * Creates a new SekolahPmdk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SekolahPmdk();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'sekolah_pmdk_id' => $model->sekolah_pmdk_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SekolahPmdk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $sekolah_pmdk_id Sekolah Pmdk ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sekolah_pmdk_id)
    {
        $model = $this->findModel($sekolah_pmdk_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sekolah_pmdk_id' => $model->sekolah_pmdk_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SekolahPmdk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $sekolah_pmdk_id Sekolah Pmdk ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($sekolah_pmdk_id)
    {
        $this->findModel($sekolah_pmdk_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SekolahPmdk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $sekolah_pmdk_id Sekolah Pmdk ID
     * @return SekolahPmdk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sekolah_pmdk_id)
    {
        if (($model = SekolahPmdk::findOne(['sekolah_pmdk_id' => $sekolah_pmdk_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
