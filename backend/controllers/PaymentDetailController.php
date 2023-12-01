<?php

namespace backend\controllers;

use backend\models\PaymentDetail;
use backend\models\PaymentDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentDetailController implements the CRUD actions for PaymentDetail model.
 */
class PaymentDetailController extends Controller
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
     * Lists all PaymentDetail models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PaymentDetailSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaymentDetail model.
     * @param int $payment_detail_id Payment Detail ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($payment_detail_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($payment_detail_id),
        ]);
    }

    /**
     * Creates a new PaymentDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PaymentDetail();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'payment_detail_id' => $model->payment_detail_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaymentDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $payment_detail_id Payment Detail ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($payment_detail_id)
    {
        $model = $this->findModel($payment_detail_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'payment_detail_id' => $model->payment_detail_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PaymentDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $payment_detail_id Payment Detail ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($payment_detail_id)
    {
        $this->findModel($payment_detail_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaymentDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $payment_detail_id Payment Detail ID
     * @return PaymentDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($payment_detail_id)
    {
        if (($model = PaymentDetail::findOne(['payment_detail_id' => $payment_detail_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
