<?php

namespace backend\controllers;

use backend\models\JenisKelamin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JenisKelaminController implements the CRUD actions for JenisKelamin model.
 */
class JenisKelaminController extends Controller
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
     * Lists all JenisKelamin models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => JenisKelamin::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'jenis_kelamin_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JenisKelamin model.
     * @param int $jenis_kelamin_id Jenis Kelamin ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($jenis_kelamin_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($jenis_kelamin_id),
        ]);
    }

    /**
     * Creates a new JenisKelamin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new JenisKelamin();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'jenis_kelamin_id' => $model->jenis_kelamin_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JenisKelamin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $jenis_kelamin_id Jenis Kelamin ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($jenis_kelamin_id)
    {
        $model = $this->findModel($jenis_kelamin_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'jenis_kelamin_id' => $model->jenis_kelamin_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JenisKelamin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $jenis_kelamin_id Jenis Kelamin ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($jenis_kelamin_id)
    {
        $this->findModel($jenis_kelamin_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JenisKelamin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $jenis_kelamin_id Jenis Kelamin ID
     * @return JenisKelamin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($jenis_kelamin_id)
    {
        if (($model = JenisKelamin::findOne(['jenis_kelamin_id' => $jenis_kelamin_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
