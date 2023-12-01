<?php

namespace backend\controllers;

use backend\models\NilaiPsikotes;
use backend\models\NilaiPsikotesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\html;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;
use yii;

/**
 * NilaiPsikotesController implements the CRUD actions for NilaiPsikotes model.
 */
class NilaiPsikotesController extends Controller
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
     * Lists all NilaiPsikotes models.
     *
     * @return string
     */
    public function actionDataForDatatables()
    {
        $draw = Yii::$app->request->get('draw');
        $start = Yii::$app->request->get('start');
        $length = Yii::$app->request->get('length');
        $query = NilaiPsikotes::find();
        $totalRecords = $query->count();
        if (!empty($search)) {
            $query->andFilterWhere(['like', 'nama', $search]);
        }
        $totalDisplayRecords = $query->count();
        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];

        foreach ($data as $nilaiPsikotes) {
            $dataArray[] = [
                'no' => $nilaiPsikotes->nilai_psikotes_id,
                'pendaftar_id' => $nilaiPsikotes->pendaftar ? $nilaiPsikotes->pendaftar->nama : 'Tidak ditemukan',
                'kode_tes' => $nilaiPsikotes->kode_tes,
                'kehadiran' => $nilaiPsikotes->kehadiran,
                'hasil' => $nilaiPsikotes->hasil,
                'action' =>
                Html::a('<i class="fa fa-eye"></i>', ['view', 'nilai_psikotes_id' => $nilaiPsikotes->nilai_psikotes_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                    . ' ' .
                    Html::a('<i class="fas fa-edit"></i>', ['update', 'nilai_psikotes_id' => $nilaiPsikotes->nilai_psikotes_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update'])

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
        $searchModel = new NilaiPsikotesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NilaiPsikotes model.
     * @param int $nilai_psikotes_id Nilai Psikotes ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nilai_psikotes_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($nilai_psikotes_id),
        ]);
    }

    /**
     * Creates a new NilaiPsikotes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new NilaiPsikotes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nilai_psikotes_id' => $model->nilai_psikotes_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NilaiPsikotes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $nilai_psikotes_id Nilai Psikotes ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nilai_psikotes_id)
    {
        $model = $this->findModel($nilai_psikotes_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nilai_psikotes_id' => $model->nilai_psikotes_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NilaiPsikotes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $nilai_psikotes_id Nilai Psikotes ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nilai_psikotes_id)
    {
        $this->findModel($nilai_psikotes_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NilaiPsikotes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $nilai_psikotes_id Nilai Psikotes ID
     * @return NilaiPsikotes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nilai_psikotes_id)
    {
        if (($model = NilaiPsikotes::findOne(['nilai_psikotes_id' => $nilai_psikotes_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpload()
    {
        $model = new NilaiPsikotes();

        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstanceByName('NilaiPsikotes[excelFile]');

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
                    $modelData = new NilaiPsikotes();
                    $modelData->nilai_psikotes_id = $row['A'];
                    $modelData->pendaftar_id = $row['B'];
                    $modelData->kode_tes = $row['C'];
                    $modelData->kehadiran = $row['D'];
                    $modelData->tiu = $row['E'];
                    $modelData->kategori_tiu = $row['F'];
                    $modelData->stabilit_as_emosi = $row['G'];
                    $modelData->temp_kerja = $row['H'];
                    $modelData->ketelitian = $row['I'];
                    $modelData->konsistensi = $row['J'];
                    $modelData->daya_tahan = $row['K'];
                    $modelData->iq = $row['L'];
                    $modelData->kategori_iq = $row['M'];
                    $modelData->hasil = $row['N'];
                    $modelData->peringkat = $row['O'];

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
