<?php

namespace backend\controllers;

use backend\models\FincTFee;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FincTFeeController implements the CRUD actions for FincTFee model.
 */
class FincTFeeController extends Controller
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
     * Lists all FincTFee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FincTFee::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'fee_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FincTFee model.
     * @param int $fee_id Fee ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fee_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($fee_id),
        ]);
    }

    /**
     * Creates a new FincTFee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new FincTFee();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'fee_id' => $model->fee_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FincTFee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $fee_id Fee ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fee_id)
    {
        $model = $this->findModel($fee_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fee_id' => $model->fee_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FincTFee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $fee_id Fee ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fee_id)
    {
        $this->findModel($fee_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FincTFee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $fee_id Fee ID
     * @return FincTFee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fee_id)
    {
        if (($model = FincTFee::findOne(['fee_id' => $fee_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
