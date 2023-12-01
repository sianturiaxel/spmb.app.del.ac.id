<?php

namespace backend\controllers;

use backend\models\UangPembangunan;
use backend\models\UangPembangunanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UangPembangunanController implements the CRUD actions for UangPembangunan model.
 */
class UangPembangunanController extends Controller
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
     * Lists all UangPembangunan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UangPembangunanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UangPembangunan model.
     * @param int $uang_pembangunan_id Uang Pembangunan ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($uang_pembangunan_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($uang_pembangunan_id),
        ]);
    }

    /**
     * Creates a new UangPembangunan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UangPembangunan();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'uang_pembangunan_id' => $model->uang_pembangunan_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UangPembangunan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $uang_pembangunan_id Uang Pembangunan ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($uang_pembangunan_id)
    {
        $model = $this->findModel($uang_pembangunan_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'uang_pembangunan_id' => $model->uang_pembangunan_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UangPembangunan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $uang_pembangunan_id Uang Pembangunan ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($uang_pembangunan_id)
    {
        $this->findModel($uang_pembangunan_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UangPembangunan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $uang_pembangunan_id Uang Pembangunan ID
     * @return UangPembangunan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($uang_pembangunan_id)
    {
        if (($model = UangPembangunan::findOne(['uang_pembangunan_id' => $uang_pembangunan_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
