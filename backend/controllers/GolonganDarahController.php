<?php

namespace backend\controllers;

use backend\models\GolonganDarah;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GolonganDarahController implements the CRUD actions for GolonganDarah model.
 */
class GolonganDarahController extends Controller
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
     * Lists all GolonganDarah models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => GolonganDarah::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'golongan_darah_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GolonganDarah model.
     * @param int $golongan_darah_id Golongan Darah ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($golongan_darah_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($golongan_darah_id),
        ]);
    }

    /**
     * Creates a new GolonganDarah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new GolonganDarah();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'golongan_darah_id' => $model->golongan_darah_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GolonganDarah model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $golongan_darah_id Golongan Darah ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($golongan_darah_id)
    {
        $model = $this->findModel($golongan_darah_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'golongan_darah_id' => $model->golongan_darah_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GolonganDarah model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $golongan_darah_id Golongan Darah ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($golongan_darah_id)
    {
        $this->findModel($golongan_darah_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GolonganDarah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $golongan_darah_id Golongan Darah ID
     * @return GolonganDarah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($golongan_darah_id)
    {
        if (($model = GolonganDarah::findOne(['golongan_darah_id' => $golongan_darah_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
