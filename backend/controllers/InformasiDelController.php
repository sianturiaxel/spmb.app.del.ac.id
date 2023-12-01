<?php

namespace backend\controllers;

use backend\models\InformasiDel;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InformasiDelController implements the CRUD actions for InformasiDel model.
 */
class InformasiDelController extends Controller
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
     * Lists all InformasiDel models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => InformasiDel::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'informasi_del_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InformasiDel model.
     * @param int $informasi_del_id Informasi Del ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($informasi_del_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($informasi_del_id),
        ]);
    }

    /**
     * Creates a new InformasiDel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new InformasiDel();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'informasi_del_id' => $model->informasi_del_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InformasiDel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $informasi_del_id Informasi Del ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($informasi_del_id)
    {
        $model = $this->findModel($informasi_del_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'informasi_del_id' => $model->informasi_del_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InformasiDel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $informasi_del_id Informasi Del ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($informasi_del_id)
    {
        $this->findModel($informasi_del_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InformasiDel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $informasi_del_id Informasi Del ID
     * @return InformasiDel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($informasi_del_id)
    {
        if (($model = InformasiDel::findOne(['informasi_del_id' => $informasi_del_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
