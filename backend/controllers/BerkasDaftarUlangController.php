<?php

namespace backend\controllers;

use backend\models\BerkasDaftarUlang;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BerkasDaftarUlangController implements the CRUD actions for BerkasDaftarUlang model.
 */
class BerkasDaftarUlangController extends Controller
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
     * Lists all BerkasDaftarUlang models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => BerkasDaftarUlang::find(),
            'sort' => [
                'defaultOrder' => ['berkas_daftar_ulang_id' => SORT_DESC]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single BerkasDaftarUlang model.
     * @param int $berkas_daftar_ulang_id Berkas Daftar Ulang ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($berkas_daftar_ulang_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($berkas_daftar_ulang_id),
        ]);
    }

    /**
     * Creates a new BerkasDaftarUlang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new BerkasDaftarUlang();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'berkas_daftar_ulang_id' => $model->berkas_daftar_ulang_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BerkasDaftarUlang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $berkas_daftar_ulang_id Berkas Daftar Ulang ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($berkas_daftar_ulang_id)
    {
        $model = $this->findModel($berkas_daftar_ulang_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'berkas_daftar_ulang_id' => $model->berkas_daftar_ulang_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BerkasDaftarUlang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $berkas_daftar_ulang_id Berkas Daftar Ulang ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($berkas_daftar_ulang_id)
    {
        $this->findModel($berkas_daftar_ulang_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BerkasDaftarUlang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $berkas_daftar_ulang_id Berkas Daftar Ulang ID
     * @return BerkasDaftarUlang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($berkas_daftar_ulang_id)
    {
        if (($model = BerkasDaftarUlang::findOne(['berkas_daftar_ulang_id' => $berkas_daftar_ulang_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
