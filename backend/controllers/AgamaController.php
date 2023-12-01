<?php

namespace backend\controllers;

use backend\models\Agama;
use backend\models\AgamaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgamaController implements the CRUD actions for Agama model.
 */
class AgamaController extends Controller
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
     * Lists all Agama models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AgamaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agama model.
     * @param int $agama_id Agama ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($agama_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($agama_id),
        ]);
    }

    /**
     * Creates a new Agama model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Agama();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'agama_id' => $model->agama_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Agama model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $agama_id Agama ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($agama_id)
    {
        $model = $this->findModel($agama_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'agama_id' => $model->agama_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Agama model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $agama_id Agama ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($agama_id)
    {
        $this->findModel($agama_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Agama model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $agama_id Agama ID
     * @return Agama the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($agama_id)
    {
        if (($model = Agama::findOne(['agama_id' => $agama_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
