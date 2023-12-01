<?php

namespace backend\controllers;

use backend\models\PenangguhanDaftarUlang;
use backend\models\PenangguhanDaftarUlangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenangguhanDaftarUlangController implements the CRUD actions for PenangguhanDaftarUlang model.
 */
class PenangguhanDaftarUlangController extends Controller
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
     * Lists all PenangguhanDaftarUlang models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PenangguhanDaftarUlangSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenangguhanDaftarUlang model.
     * @param int $penangguhan_daftar_ulang_id Penangguhan Daftar Ulang ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($penangguhan_daftar_ulang_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($penangguhan_daftar_ulang_id),
        ]);
    }

    /**
     * Creates a new PenangguhanDaftarUlang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PenangguhanDaftarUlang();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'penangguhan_daftar_ulang_id' => $model->penangguhan_daftar_ulang_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PenangguhanDaftarUlang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $penangguhan_daftar_ulang_id Penangguhan Daftar Ulang ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($penangguhan_daftar_ulang_id)
    {
        $model = $this->findModel($penangguhan_daftar_ulang_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'penangguhan_daftar_ulang_id' => $model->penangguhan_daftar_ulang_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PenangguhanDaftarUlang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $penangguhan_daftar_ulang_id Penangguhan Daftar Ulang ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($penangguhan_daftar_ulang_id)
    {
        $this->findModel($penangguhan_daftar_ulang_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PenangguhanDaftarUlang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $penangguhan_daftar_ulang_id Penangguhan Daftar Ulang ID
     * @return PenangguhanDaftarUlang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($penangguhan_daftar_ulang_id)
    {
        if (($model = PenangguhanDaftarUlang::findOne(['penangguhan_daftar_ulang_id' => $penangguhan_daftar_ulang_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
