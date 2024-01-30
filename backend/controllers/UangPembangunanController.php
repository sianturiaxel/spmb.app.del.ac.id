<?php

namespace backend\controllers;

use backend\models\UangPembangunan;
use backend\models\GelombangPendaftaran;
use backend\models\JenisUjian;
use backend\models\Jurusan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

use yii;

/**
 * UangPembangunanController implements the CRUD actions for UangPembangunan model.
 */
class UangPembangunanController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [ // Key 'timestamp' ini hanya untuk identifikasi, bisa diisi dengan string lain.
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'), // Atau fungsi waktu yang sesuai dengan DBMS Anda
            ],
            'blameable' => [ // Key 'blameable' ini hanya untuk identifikasi, bisa diisi dengan string lain.
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }


    /**
     * Lists all UangPembangunan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => UangPembangunan::find()->with('gelombangPendaftaran', 'jurusan'),
            'sort' => [
                'defaultOrder' => ['uang_pembangunan_id' => SORT_DESC] // Sesuaikan field jika diperlukan
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UangPembangunan model.
     * @param int $uang_pembangunan_id Uang Pembangunan ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($uang_pembangunan_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($uang_pembangunan_id),
        ]);
    }

    /**
     * Creates a new UangPembangunan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UangPembangunan();
        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();

        $jurusan = Jurusan::find()
            ->all();
        if ($this->request->isPost) {
            $postData = $this->request->post();
            var_dump($postData); // Check the POST data
            if ($model->load($postData)) {
                if (!$model->save()) {
                    var_dump($model->getErrors()); // Check for any errors if save fails
                } else {
                    return $this->redirect(['view', 'uang_pembangunan_id' => $model->uang_pembangunan_id]);
                }
            } else {
                Yii::error("Model could not be loaded with the request data.");
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'jurusan' => $jurusan,
        ]);
    }

    /**
     * Updates an existing UangPembangunan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $uang_pembangunan_id Uang Pembangunan ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($uang_pembangunan_id)
    {
        $model = $this->findModel($uang_pembangunan_id);
        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();

        $jurusan = Jurusan::find()
            ->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'uang_pembangunan_id' => $model->uang_pembangunan_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'jurusan' => $jurusan,
        ]);
    }

    /**
     * Deletes an existing UangPembangunan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $uang_pembangunan_id Uang Pembangunan ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($uang_pembangunan_id)
    {
        $this->findModel($uang_pembangunan_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UangPembangunan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $uang_pembangunan_id Uang Pembangunan ID
     * @return UangPembangunan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($uang_pembangunan_id)
    {
        if (($model = UangPembangunan::findOne(['uang_pembangunan_id' => $uang_pembangunan_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
