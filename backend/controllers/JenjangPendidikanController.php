<?php

namespace backend\controllers;

use backend\models\JenjangPendidikan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JenjangPendidikanController implements the CRUD actions for JenjangPendidikan model.
 */
class JenjangPendidikanController extends Controller
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
     * Lists all JenjangPendidikan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => JenjangPendidikan::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'jenjang_pendidikan_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JenjangPendidikan model.
     * @param int $jenjang_pendidikan_id Jenjang Pendidikan ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($jenjang_pendidikan_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($jenjang_pendidikan_id),
        ]);
    }

    /**
     * Creates a new JenjangPendidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new JenjangPendidikan();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'jenjang_pendidikan_id' => $model->jenjang_pendidikan_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JenjangPendidikan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $jenjang_pendidikan_id Jenjang Pendidikan ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($jenjang_pendidikan_id)
    {
        $model = $this->findModel($jenjang_pendidikan_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'jenjang_pendidikan_id' => $model->jenjang_pendidikan_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JenjangPendidikan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $jenjang_pendidikan_id Jenjang Pendidikan ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($jenjang_pendidikan_id)
    {
        $this->findModel($jenjang_pendidikan_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JenjangPendidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $jenjang_pendidikan_id Jenjang Pendidikan ID
     * @return JenjangPendidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($jenjang_pendidikan_id)
    {
        if (($model = JenjangPendidikan::findOne(['jenjang_pendidikan_id' => $jenjang_pendidikan_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
