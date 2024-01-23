<?php

namespace backend\controllers;

use backend\models\GelombangPendaftaran;
use backend\models\JenisTest;
use backend\models\KodeUjian;
use backend\models\KodeUjianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use yii;
use Exception;

/**
 * KodeUjianController implements the CRUD actions for KodeUjian model.
 */
class KodeUjianController extends Controller
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
     * Lists all KodeUjian models.
     *
     * @return string
     */
    public function actionDataForDatatables()
    {
        $draw = Yii::$app->request->get('draw');
        $start = Yii::$app->request->get('start');
        $length = Yii::$app->request->get('length');
        $query = KodeUjian::find();
        $totalRecords = $query->count();
        if (!empty($search)) {
            $query->andFilterWhere(['like', 'nama', $search]);
        }
        if (!empty($_GET['gelombang_pendaftaran_id'])) {
            $query->andWhere(['gelombang_pendaftaran_id' => $_GET['gelombang_pendaftaran_id']]);
        }
        $totalDisplayRecords = $query->count();
        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];

        foreach ($data as $kodeUjian) {
            $statusToggleHTML = $kodeUjian->status == 1
                ? '<label class="switch"><input class="status-toggle" type="checkbox" checked data-id="' . $kodeUjian->kode_ujian_id . '"><span class="slider round"></span></label>'
                : '<label class="switch"><input class="status-toggle" type="checkbox" data-id="' . $kodeUjian->kode_ujian_id . '"><span class="slider round"></span></label>';

            $dataArray[] = [
                'no' => $kodeUjian->kode_ujian_id,
                'gelombang_pendaftaran' => $kodeUjian->gelombangPendaftaran ? $kodeUjian->gelombangPendaftaran->desc : 'Tidak ditemukan',
                'jenis_test' => $kodeUjian->jenisTest ? $kodeUjian->jenisTest->nama : 'Tidak ditemukan',
                'kode_ujian' => $kodeUjian->kode_ujian,
                'status' => $statusToggleHTML,
                'action' =>
                Html::a('<i class="fa fa-eye"></i>', ['view', 'kode_ujian_id' => $kodeUjian->kode_ujian_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                    . ' ' .
                    Html::a('<i class="fas fa-edit"></i>', ['update', 'kode_ujian_id' => $kodeUjian->kode_ujian_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update'])

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
        $searchModel = new KodeUjianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        // $gelombangPendaftaran = KodeUjian::find()->with('gelombangPendaftaran')->all();
        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();
        $jenisTest = KodeUjian::find()->with('jenisTest')->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gelombangPendaftaran' => $gelombangPendaftaran,

            'jenisTest' => $jenisTest,
        ]);
    }

    /**
     * Displays a single KodeUjian model.
     * @param int $kode_ujian_id Kode Ujian ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($kode_ujian_id)
    {
        $gelombangPendaftaran = GelombangPendaftaran::find()->asArray()->all();
        $jenisTest = JenisTest::find()->asArray()->all();

        return $this->render('view', [
            'model' => $this->findModel($kode_ujian_id),
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'jenisTest' => $jenisTest,
        ]);
    }

    /**
     * Creates a new KodeUjian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new KodeUjian();
        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();

        $jenisTest = JenisTest::find()->asArray()->all();


        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'kode_ujian_id' => $model->kode_ujian_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'jenisTest' => $jenisTest,
        ]);
    }

    /**
     * Updates an existing KodeUjian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $kode_ujian_id Kode Ujian ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($kode_ujian_id)
    {
        $model = $this->findModel($kode_ujian_id);
        $gelombangPendaftaran = GelombangPendaftaran::find()->asArray()->all();
        $jenisTest = JenisTest::find()->asArray()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'kode_ujian_id' => $model->kode_ujian_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'jenisTest' => $jenisTest,
        ]);
    }
    public function actionUpdateStatus()
    {
        if (!Yii::$app->request->isAjax) {
            throw new BadRequestHttpException('Invalid request');
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        $kode_ujian_id = Yii::$app->request->post('kode_ujian_id');
        $status = Yii::$app->request->post('status');

        $model = KodeUjian::findOne($kode_ujian_id);
        if (!$model) {
            return ['success' => false, 'message' => 'Kode Ujian not found.'];
        }

        $model->status = (int)$status;
        if ($model->save()) {
            return ['success' => true, 'message' => 'Status updated.'];
        } else {
            $errors = $model->getErrors();
            Yii::error("Failed to toggle status: " . json_encode($errors), __METHOD__);
            return ['success' => false, 'message' => 'Failed to update status.', 'errors' => $errors];
        }
    }


    /**
     * Deletes an existing KodeUjian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $kode_ujian_id Kode Ujian ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($kode_ujian_id)
    {
        $this->findModel($kode_ujian_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KodeUjian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $kode_ujian_id Kode Ujian ID
     * @return KodeUjian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($kode_ujian_id)
    {
        if (($model = KodeUjian::findOne(['kode_ujian_id' => $kode_ujian_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpload()
    {
        $model = new KodeUjian();

        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstanceByName('KodeUjian[excelFile]');

            if (!$model->excelFile) {
                die("File tidak terunggah");
            }

            // Debug: Cetak nama file yang diunggah
            //print_r("Nama File: " . $model->excelFile->baseName . "\n");

            if ($model->validate()) {
                $filePath = Yii::getAlias('@webroot') . '/uploads/' . $model->excelFile->baseName . '.' . $model->excelFile->extension;

                $model->excelFile->saveAs($filePath);

                // Debug: Cetak lokasi file yang disimpan
                //print_r("File disimpan di: " . $filePath . "\n");

                $spreadsheet = IOFactory::load($filePath);
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true, true, 'A2');

                // Debug: Cetak data Excel
                //var_dump($sheetData);
                //die();

                foreach ($sheetData as $row) {
                    //print_r($row);
                    //die();
                    $modelData = new KodeUjian();
                    $modelData->kode_ujian_id = $row['A'];
                    $modelData->gelombang_pendaftaran_id = $row['B'];
                    $modelData->jenis_test_id = $row['C'];
                    $modelData->kode_ujian = $row['D'];
                    $modelData->username = $row['E'];
                    $modelData->password = $row['F'];
                    $modelData->status = $row['G'];

                    if (!$modelData->save()) {
                        print_r($modelData->getErrors()); // Debug
                        //die(); // Hentikan eksekusi untuk debugging
                    }
                }

                unlink($filePath); // Hapus file setelah diproses
                return $this->redirect(['index']); // Redirect setelah selesai
            } else {
                // Debug: Cetak error validasi
                print_r($model->getErrors());
                die();
            }
        } else {
            return $this->render('upload', ['model' => $model]);
        }
    }
}
