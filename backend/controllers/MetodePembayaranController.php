<?php

namespace backend\controllers;

use backend\models\MetodePembayaran;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MetodePembayaranController implements the CRUD actions for MetodePembayaran model.
 */
class MetodePembayaranController extends Controller
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
     * Lists all MetodePembayaran models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => MetodePembayaran::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'metode_pembayaran_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MetodePembayaran model.
     * @param int $metode_pembayaran_id Metode Pembayaran ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($metode_pembayaran_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($metode_pembayaran_id),
        ]);
    }

    /**
     * Creates a new MetodePembayaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MetodePembayaran();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'metode_pembayaran_id' => $model->metode_pembayaran_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MetodePembayaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $metode_pembayaran_id Metode Pembayaran ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($metode_pembayaran_id)
    {
        $model = $this->findModel($metode_pembayaran_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'metode_pembayaran_id' => $model->metode_pembayaran_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MetodePembayaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $metode_pembayaran_id Metode Pembayaran ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($metode_pembayaran_id)
    {
        $this->findModel($metode_pembayaran_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MetodePembayaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $metode_pembayaran_id Metode Pembayaran ID
     * @return MetodePembayaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($metode_pembayaran_id)
    {
        if (($model = MetodePembayaran::findOne(['metode_pembayaran_id' => $metode_pembayaran_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
