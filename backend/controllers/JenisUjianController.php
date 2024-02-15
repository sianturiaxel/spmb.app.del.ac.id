<?php

namespace backend\controllers;

use backend\models\JenisUjian;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JenisUjianController implements the CRUD actions for JenisUjian model.
 */
class JenisUjianController extends Controller
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
     * Lists all JenisUjian models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => JenisUjian::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'jenis_ujian_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JenisUjian model.
     * @param int $jenis_ujian_id Jenis Ujian ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($jenis_ujian_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($jenis_ujian_id),
        ]);
    }

    /**
     * Creates a new JenisUjian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new JenisUjian();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'jenis_ujian_id' => $model->jenis_ujian_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JenisUjian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $jenis_ujian_id Jenis Ujian ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($jenis_ujian_id)
    {
        $model = $this->findModel($jenis_ujian_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'jenis_ujian_id' => $model->jenis_ujian_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JenisUjian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $jenis_ujian_id Jenis Ujian ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($jenis_ujian_id)
    {
        $this->findModel($jenis_ujian_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JenisUjian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $jenis_ujian_id Jenis Ujian ID
     * @return JenisUjian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($jenis_ujian_id)
    {
        if (($model = JenisUjian::findOne(['jenis_ujian_id' => $jenis_ujian_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
