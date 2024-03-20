<?php

namespace backend\controllers;

use backend\models\Fakultas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FakultasController implements the CRUD actions for Fakultas model.
 */
class FakultasController extends Controller
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
     * Lists all Fakultas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Fakultas::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'fakultas_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fakultas model.
     * @param int $fakultas_id Fakultas ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fakultas_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($fakultas_id),
        ]);
    }

    /**
     * Creates a new Fakultas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Fakultas();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'fakultas_id' => $model->fakultas_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fakultas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $fakultas_id Fakultas ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fakultas_id)
    {
        $model = $this->findModel($fakultas_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fakultas_id' => $model->fakultas_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fakultas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $fakultas_id Fakultas ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fakultas_id)
    {
        $this->findModel($fakultas_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Fakultas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $fakultas_id Fakultas ID
     * @return Fakultas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fakultas_id)
    {
        if (($model = Fakultas::findOne(['fakultas_id' => $fakultas_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
