<?php

namespace backend\controllers;

use backend\models\Kabupaten;
use yii\helpers\Url;
use backend\models\Kecamatan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii;

/**
 * KecamatanController implements the CRUD actions for Kecamatan model.
 */
class KecamatanController extends Controller
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
     * Lists all Kecamatan models.
     *
     * @return string
     */


    public function actionDataForDatatables()
    {
        $draw = Yii::$app->request->get('draw');
        $start = Yii::$app->request->get('start');
        $length = Yii::$app->request->get('length');
        $query = Kecamatan::find();
        $totalRecords = $query->count();
        if (!empty($search)) {
            $query->andFilterWhere(['like', 'nama', $search]);
        }
        $totalDisplayRecords = $query->count();
        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];

        foreach ($data as $kecamatan) {
            $dataArray[] = [
                'no' => $kecamatan->kecamatan_id,
                'kode_kabupaten' => $kecamatan->kabupaten_id,
                'kode_kecamatan' => $kecamatan->kecamatan_id,
                'nama_kecamatan' => $kecamatan->nama,
                'action' =>
                Html::a('<i class="fa fa-eye"></i>', ['view', 'kecamatan_id' => $kecamatan->kecamatan_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                    . ' ' .
                    Html::a('<i class="fas fa-edit"></i>', ['update', 'kecamatan_id' => $kecamatan->kecamatan_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update'])
                    . ' ' .
                    Html::a('<i class="fa fa-trash"></i>', ['delete', 'kecamatan_id' => $kecamatan->kecamatan_id], ['class' => 'btn btn-danger btn-xs', 'title' => 'Delete', 'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ]]),
            ];
        }
        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalDisplayRecords,
            "data" => $dataArray
        ];

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
    }

    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Kecamatan::find(),
            'sort' => [
                'defaultOrder' => ['kecamatan_id']
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kecamatan model.
     * @param int $kecamatan_id Kecamatan ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($kecamatan_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($kecamatan_id),
        ]);
    }

    /**
     * Creates a new Kecamatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Kecamatan();
        $kabupaten = Kabupaten::find()->asArray()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'kecamatan_id' => $model->kecamatan_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'kabupaten' => $kabupaten,
        ]);
    }

    /**
     * Updates an existing Kecamatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $kecamatan_id Kecamatan ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($kecamatan_id)
    {
        $model = $this->findModel($kecamatan_id);
        $kabupaten = Kabupaten::find()->asArray()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'kecamatan_id' => $model->kecamatan_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'kabupaten' => $kabupaten,
        ]);
    }

    /**
     * Deletes an existing Kecamatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $kecamatan_id Kecamatan ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($kecamatan_id)
    {
        $this->findModel($kecamatan_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kecamatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $kecamatan_id Kecamatan ID
     * @return Kecamatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($kecamatan_id)
    {
        if (($model = Kecamatan::findOne(['kecamatan_id' => $kecamatan_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
