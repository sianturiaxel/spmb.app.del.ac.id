<?php

namespace backend\controllers;

use backend\models\Fakultas;
use backend\models\Jurusan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JurusanController implements the CRUD actions for Jurusan model.
 */
class JurusanController extends Controller
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
     * Lists all Jurusan models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Jurusan::find(),
        ]);

        return $this->render('index', [

            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Jurusan model.
     * @param int $jurusan_id Jurusan ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($jurusan_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($jurusan_id),
        ]);
    }

    /**
     * Creates a new Jurusan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Jurusan();
        $fakultas = Fakultas::find()->asArray()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'jurusan_id' => $model->jurusan_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'fakultas' => $fakultas,
        ]);
    }

    /**
     * Updates an existing Jurusan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $jurusan_id Jurusan ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($jurusan_id)
    {
        $model = $this->findModel($jurusan_id);
        $fakultas = Fakultas::find()->asArray()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'jurusan_id' => $model->jurusan_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'fakultas' => $fakultas,
        ]);
    }

    /**
     * Deletes an existing Jurusan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $jurusan_id Jurusan ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($jurusan_id)
    {
        $this->findModel($jurusan_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jurusan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $jurusan_id Jurusan ID
     * @return Jurusan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($jurusan_id)
    {
        if (($model = Jurusan::findOne(['jurusan_id' => $jurusan_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
