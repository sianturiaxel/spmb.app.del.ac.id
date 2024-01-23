<?php

namespace backend\controllers;

use backend\models\UangDaftarUlang;
use backend\models\UangDaftarUlangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UangDaftarUlangController implements the CRUD actions for UangDaftarUlang model.
 */
class UangDaftarUlangController extends Controller
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
     * Lists all UangDaftarUlang models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UangDaftarUlangSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $gelombangPendaftaran = UangDaftarUlang::find()->with('gelombangPendaftaran')->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gelombangPendaftaran' => $gelombangPendaftaran,
        ]);
    }

    /**
     * Displays a single UangDaftarUlang model.
     * @param int $uang_daftar_ulang_id Uang Daftar Ulang ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($uang_daftar_ulang_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($uang_daftar_ulang_id),
        ]);
    }

    /**
     * Creates a new UangDaftarUlang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UangDaftarUlang();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'uang_daftar_ulang_id' => $model->uang_daftar_ulang_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UangDaftarUlang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $uang_daftar_ulang_id Uang Daftar Ulang ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($uang_daftar_ulang_id)
    {
        $model = $this->findModel($uang_daftar_ulang_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'uang_daftar_ulang_id' => $model->uang_daftar_ulang_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UangDaftarUlang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $uang_daftar_ulang_id Uang Daftar Ulang ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($uang_daftar_ulang_id)
    {
        $this->findModel($uang_daftar_ulang_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UangDaftarUlang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $uang_daftar_ulang_id Uang Daftar Ulang ID
     * @return UangDaftarUlang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($uang_daftar_ulang_id)
    {
        if (($model = UangDaftarUlang::findOne(['uang_daftar_ulang_id' => $uang_daftar_ulang_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
