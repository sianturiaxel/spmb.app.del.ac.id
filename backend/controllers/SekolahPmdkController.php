<?php

namespace backend\controllers;

use backend\models\Sekolah;
use backend\models\SekolahPmdk;
use backend\models\SekolahPmdkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

/**
 * SekolahPmdkController implements the CRUD actions for SekolahPmdk model.
 */
class SekolahPmdkController extends Controller
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
        $searchModel = new SekolahPmdkSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $sekolah = SekolahPmdk::find()->with('sekolah')->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sekolah' => $sekolah,
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
        $sekolah = Sekolah::find()->asArray()->all();
        return $this->render('view', [
            'model' => $this->findModel($sekolah_pmdk_id),
            'sekolah' => $sekolah,
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
        $sekolah = Sekolah::find()->asArray()->all();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'sekolah_pmdk_id' => $model->sekolah_pmdk_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'sekolah' => $sekolah,
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
        $sekolah = Sekolah::find()->asArray()->all();
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sekolah_pmdk_id' => $model->sekolah_pmdk_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'sekolah' => $sekolah,

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
