<?php

namespace backend\controllers;

use backend\models\Jurusan;
use backend\models\JurusanMapel;
use backend\models\JurusanMapelSearch;
use backend\models\MataPelajaran;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JurusanMapelController implements the CRUD actions for JurusanMapel model.
 */
class JurusanMapelController extends Controller
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
     * Lists all JurusanMapel models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new JurusanMapelSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $jurusanMapelQuery = JurusanMapel::find()->with('jurusan', 'mataPelajaran');

        $jurusanMapelData = [];

        foreach ($jurusanMapelQuery->all() as $jm) {
            $jurusanNama = $jm->jurusan ? $jm->jurusan->nama : 'Data tidak tersedia';
            $mapelNama = $jm->mataPelajaran ? $jm->mataPelajaran->name : 'Data tidak tersedia';

            if (!array_key_exists($jm->jurusan_id, $jurusanMapelData)) {
                $jurusanMapelData[$jm->jurusan_id] = [
                    'nama' => $jurusanNama,
                    'mapel' => []
                ];
            }
            $jurusanMapelData[$jm->jurusan_id]['mapel'][] = $mapelNama;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jurusanMapelData' => $jurusanMapelData,
        ]);
    }





    /**
     * Displays a single JurusanMapel model.
     * @param int $jurusan_mapel_id Jurusan Mapel ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($jurusan_mapel_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($jurusan_mapel_id),
        ]);
    }

    /**
     * Creates a new JurusanMapel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new JurusanMapel();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'jurusan_mapel_id' => $model->jurusan_mapel_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JurusanMapel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $jurusan_mapel_id Jurusan Mapel ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($jurusan_mapel_id)
    {
        $model = $this->findModel($jurusan_mapel_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'jurusan_mapel_id' => $model->jurusan_mapel_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JurusanMapel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $jurusan_mapel_id Jurusan Mapel ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($jurusan_mapel_id)
    {
        $this->findModel($jurusan_mapel_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JurusanMapel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $jurusan_mapel_id Jurusan Mapel ID
     * @return JurusanMapel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($jurusan_mapel_id)
    {
        if (($model = JurusanMapel::findOne(['jurusan_mapel_id' => $jurusan_mapel_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
