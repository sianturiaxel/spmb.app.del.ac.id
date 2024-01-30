<?php

namespace backend\controllers;

use backend\models\BidangUtbk;
use backend\models\KategoriBidangUtbk;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BidangUtbkController implements the CRUD actions for BidangUtbk model.
 */
class BidangUtbkController extends Controller
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
     * Lists all BidangUtbk models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => BidangUtbk::find(),
            'sort' => [
                'defaultOrder' => ['bidang_utbk_id' => SORT_DESC]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BidangUtbk model.
     * @param int $bidang_utbk_id Bidang Utbk ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($bidang_utbk_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($bidang_utbk_id),
        ]);
    }

    /**
     * Creates a new BidangUtbk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new BidangUtbk();
        $kategoriBidangUtbk = KategoriBidangUtbk::find()->asArray()->all();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'bidang_utbk_id' => $model->bidang_utbk_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'kategoriBidangUtbk' => $kategoriBidangUtbk,
        ]);
    }

    /**
     * Updates an existing BidangUtbk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $bidang_utbk_id Bidang Utbk ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($bidang_utbk_id)
    {

        $model = $this->findModel($bidang_utbk_id);
        $kategoriBidangUtbk = KategoriBidangUtbk::find()->asArray()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'bidang_utbk_id' => $model->bidang_utbk_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'kategoriBidangUtbk' => $kategoriBidangUtbk,
        ]);
    }

    /**
     * Deletes an existing BidangUtbk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $bidang_utbk_id Bidang Utbk ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($bidang_utbk_id)
    {
        $this->findModel($bidang_utbk_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BidangUtbk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $bidang_utbk_id Bidang Utbk ID
     * @return BidangUtbk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($bidang_utbk_id)
    {
        if (($model = BidangUtbk::findOne(['bidang_utbk_id' => $bidang_utbk_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
