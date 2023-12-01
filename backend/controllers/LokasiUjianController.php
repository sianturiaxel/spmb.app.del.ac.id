<?php

namespace backend\controllers;

use backend\models\LokasiUjian;
use backend\models\LokasiUjianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use Yii;


/**
 * LokasiUjianController implements the CRUD actions for LokasiUjian model.
 */
class LokasiUjianController extends Controller
{
    /**
     * @inheritDoc
     */
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
            return false;
        }
        $roles = Yii::$app->user->identity->roles;
        $roleNames = array_map(function ($role) {
            return $role->name;
        }, $roles);
        // var_dump($roleNames);
        // die(); //
        $allowedRoles = ['Admin', 'Kaprodi'];

        if (count(array_intersect($allowedRoles, $roleNames)) === 0) {
            throw new ForbiddenHttpException('Mohon Maaf Anda tidak memiliki izin untuk melihat halaman ini.');
        }
        return parent::beforeAction($action);
    }




    /**
     * Lists all LokasiUjian models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LokasiUjianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LokasiUjian model.
     * @param int $lokasi_ujian_id Lokasi Ujian ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($lokasi_ujian_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($lokasi_ujian_id),
        ]);
    }

    /**
     * Creates a new LokasiUjian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LokasiUjian();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'lokasi_ujian_id' => $model->lokasi_ujian_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LokasiUjian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $lokasi_ujian_id Lokasi Ujian ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($lokasi_ujian_id)
    {
        $model = $this->findModel($lokasi_ujian_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'lokasi_ujian_id' => $model->lokasi_ujian_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LokasiUjian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $lokasi_ujian_id Lokasi Ujian ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($lokasi_ujian_id)
    {
        $this->findModel($lokasi_ujian_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LokasiUjian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $lokasi_ujian_id Lokasi Ujian ID
     * @return LokasiUjian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($lokasi_ujian_id)
    {
        if (($model = LokasiUjian::findOne(['lokasi_ujian_id' => $lokasi_ujian_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
