<?php

namespace backend\controllers;

use backend\models\NilaiAkademik;
use backend\models\NilaiWawancara;
use backend\models\NilaiWawancaraSearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\helpers\html;
use yii\helpers\Json;
use yii;


/**
 * NilaiWawancaraController implements the CRUD actions for NilaiWawancara model.
 */
class NilaiWawancaraController extends Controller
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
                        'upload' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionDataForDatatables()
    {
        $draw = Yii::$app->request->get('draw');
        $start = Yii::$app->request->get('start');
        $length = Yii::$app->request->get('length');
        $query = NilaiWawancara::find();
        $totalRecords = $query->count();
        if (!empty($search)) {
            $query->andFilterWhere(['like', 'nama', $search]);
        }
        $totalDisplayRecords = $query->count();
        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];

        foreach ($data as $nilaiWawancara) {
            $dataArray[] = [
                'no' => $nilaiWawancara->nilai_wawancara_id,
                'pendaftar_id' => $nilaiWawancara->pendaftar ? $nilaiWawancara->pendaftar->nama : 'Tidak ditemukan',
                'nilai_motivasi' => $nilaiWawancara->nilai_motivasi,
                'nilai_gambaran_karir' => $nilaiWawancara->nilai_gambaran_karir,
                'nilai_rekomendasi' => $nilaiWawancara->nilai_rekomendasi,
                'action' =>
                Html::a('<i class="fa fa-eye"></i>', ['view', 'nilai_wawancara_id' => $nilaiWawancara->nilai_wawancara_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                    . ' ' .
                    Html::a('<i class="fas fa-edit"></i>', ['update', 'nilai_wawancara_id' => $nilaiWawancara->nilai_wawancara_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update'])

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
    /**
     * Lists all NilaiWawancara models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NilaiWawancaraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NilaiWawancara model.
     * @param int $nilai_wawancara_id Nilai Wawancara ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nilai_wawancara_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($nilai_wawancara_id),
        ]);
    }

    /**
     * Creates a new NilaiWawancara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new NilaiWawancara();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nilai_wawancara_id' => $model->nilai_wawancara_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NilaiWawancara model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $nilai_wawancara_id Nilai Wawancara ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nilai_wawancara_id)
    {
        $model = $this->findModel($nilai_wawancara_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nilai_wawancara_id' => $model->nilai_wawancara_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NilaiWawancara model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $nilai_wawancara_id Nilai Wawancara ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nilai_wawancara_id)
    {
        $this->findModel($nilai_wawancara_id)->delete();

        return $this->redirect(['index']);
    }


    public function actionUpload()
    {
        $model = new NilaiWawancara();

        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstanceByName('NilaiWawancara[excelFile]');

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
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true, true, true, 'A2');

                // Debug: Cetak data Excel
                //var_dump($sheetData);
                //die();

                foreach ($sheetData as $row) {
                    //print_r($row);
                    //die();
                    $modelData = new NilaiWawancara();
                    $modelData->nilai_wawancara_id = $row['A'];
                    $modelData->pendaftar_id = $row['B'];
                    $modelData->nilai_motivasi = $row['C'];
                    $modelData->nilai_gambaran_karir = $row['D'];
                    $modelData->nilai_rekomendasi = $row['E'];

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


    /**
     * Finds the NilaiWawancara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @    ram int $nilai_wawancara_id Nilai Wawancara ID
     * @return NilaiWawancara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nilai_wawancara_id)
    {
        if (($model = NilaiWawancara::findOne(['nilai_wawancara_id' => $nilai_wawancara_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
