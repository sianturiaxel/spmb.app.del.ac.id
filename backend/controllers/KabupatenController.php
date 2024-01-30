<?php

namespace backend\controllers;

use backend\models\Kabupaten;
use backend\models\Provinsi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KabupatenController implements the CRUD actions for Kabupaten model.
 */
class KabupatenController extends Controller
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
     * Lists all Kabupaten models.
     *
     * @return string
     */



    /**
     * Displays a single Kabupaten model.
     * @param int $kabupaten_id Kabupaten ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($kabupaten_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($kabupaten_id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Kabupaten();
        $provinsi = Provinsi::find()->asArray()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'kabupaten_id' => $model->kabupaten_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'provinsi' => $provinsi,
        ]);
    }


    /**
     * Creates a new Kabupaten model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Kabupaten::find(),
        ]);
        $provinsi = Provinsi::find()->asArray()->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'provinsi' => $provinsi,
        ]);
    }

    /**
     * Updates an existing Kabupaten model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $kabupaten_id Kabupaten ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($kabupaten_id)
    {
        $model = $this->findModel($kabupaten_id);
        $provinsi = Provinsi::find()->asArray()->all();


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'kabupaten_id' => $model->kabupaten_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'provinsi' => $provinsi,
        ]);
    }

    /**
     * Deletes an existing Kabupaten model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $kabupaten_id Kabupaten ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($kabupaten_id)
    {
        $this->findModel($kabupaten_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kabupaten model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $kabupaten_id Kabupaten ID
     * @return Kabupaten the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($kabupaten_id)
    {
        if (($model = Kabupaten::findOne(['kabupaten_id' => $kabupaten_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
