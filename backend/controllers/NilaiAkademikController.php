<?php

namespace backend\controllers;

use backend\models\NilaiAkademik;
use backend\models\NilaiAkademikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NilaiAkademikController implements the CRUD actions for NilaiAkademik model.
 */
class NilaiAkademikController extends Controller
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
     * Lists all NilaiAkademik models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NilaiAkademikSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NilaiAkademik model.
     * @param int $nilai_akademik_id Nilai Akademik ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nilai_akademik_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($nilai_akademik_id),
        ]);
    }

    /**
     * Creates a new NilaiAkademik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new NilaiAkademik();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nilai_akademik_id' => $model->nilai_akademik_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NilaiAkademik model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $nilai_akademik_id Nilai Akademik ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nilai_akademik_id)
    {
        $model = $this->findModel($nilai_akademik_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nilai_akademik_id' => $model->nilai_akademik_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NilaiAkademik model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $nilai_akademik_id Nilai Akademik ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nilai_akademik_id)
    {
        $this->findModel($nilai_akademik_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NilaiAkademik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $nilai_akademik_id Nilai Akademik ID
     * @return NilaiAkademik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nilai_akademik_id)
    {
        if (($model = NilaiAkademik::findOne(['nilai_akademik_id' => $nilai_akademik_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
