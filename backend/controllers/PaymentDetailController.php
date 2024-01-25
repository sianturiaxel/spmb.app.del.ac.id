<?php

namespace backend\controllers;

use backend\models\PaymentDetail;
use backend\models\PaymentDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii;

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


    public function actionDataForDatatables()
    {
        $draw = Yii::$app->request->get('draw');
        $start = Yii::$app->request->get('start');
        $length = Yii::$app->request->get('length');
        $query = PaymentDetail::find();
        $totalRecords = $query->count();
        if (!empty($search)) {
            $query->andFilterWhere(['like', 'nama', $search]);
        }
        $totalDisplayRecords = $query->count();
        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];

        foreach ($data as $payment) {
            $dataArray[] = [
                'no' => $payment->payment_detail_id,
                'calon_mahasiswa' => $payment->calonMahasiswa ? $payment->calonMahasiswa->nama : 'Tidak ditemukan',
                'total_ammount' => $payment->total_amount,
                'fee_name' => $payment->fee_name,
                'action' =>
                Html::a('<i class="fa fa-eye"></i>', ['view', 'payment_detail_id' => $payment->payment_detail_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                    . ' ' .
                    Html::a('<i class="fas fa-edit"></i>', ['update', 'payment_detail_id' => $payment->payment_detail_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update'])
                    . ' ' .
                    Html::a('<i class="fa fa-trash"></i>', ['delete', 'payment_detail_id' => $payment->payment_detail_id], ['class' => 'btn btn-danger btn-xs', 'title' => 'Delete', 'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ]]),
            ];
        }
        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalDisplayRecords,
            "data" => $dataArray
        ];

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
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
