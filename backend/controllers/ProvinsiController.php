<?php

namespace backend\controllers;

use backend\models\Provinsi;
use backend\models\ProvinsiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProvinsiController implements the CRUD actions for Provinsi model.
 */
class ProvinsiController extends Controller
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
     * Lists all Provinsi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProvinsiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Provinsi model.
     * @param int $provinsi_id Provinsi ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($provinsi_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($provinsi_id),
        ]);
    }

    /**
     * Creates a new Provinsi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Provinsi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'provinsi_id' => $model->provinsi_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Provinsi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $provinsi_id Provinsi ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($provinsi_id)
    {
        $model = $this->findModel($provinsi_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'provinsi_id' => $model->provinsi_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Provinsi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $provinsi_id Provinsi ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($provinsi_id)
    {
        $this->findModel($provinsi_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Provinsi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $provinsi_id Provinsi ID
     * @return Provinsi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($provinsi_id)
    {
        if (($model = Provinsi::findOne(['provinsi_id' => $provinsi_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
