<?php

namespace backend\controllers;

use backend\models\NilaiAkademik;
use backend\models\NilaiAkademikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;
use yii\helpers\html;
use yii;

/**
 * NilaiAkademikController implements the CRUD actions for NilaiAkademik model.
 */
class NilaiAkademikController extends Controller
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

    public function actionDataForDatatables()
    {
        $draw = Yii::$app->request->get('draw');
        $start = Yii::$app->request->get('start');
        $length = Yii::$app->request->get('length');
        $query = NilaiAkademik::find();
        $query->joinWith(['pendaftar p']);
        $totalRecords = $query->count();
        $search = Yii::$app->request->getQueryParam('search', null);
        if ($search && !empty($search['value'])) {
            $query->andFilterWhere(['like', 'p.nama', $search['value']]);
        }
        $totalDisplayRecords = $query->count();
        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];

        foreach ($data as $nilaiAkademik) {
            $dataArray[] = [
                'no' => $nilaiAkademik->nilai_akademik_id,
                'pendaftar_id' => $nilaiAkademik->pendaftar ? $nilaiAkademik->pendaftar->nama : 'Tidak ditemukan',
                'jumlah_soal' => $nilaiAkademik->jumlah_soal,
                'hasil_score' => $nilaiAkademik->hasil_score,
                'scala_score' => $nilaiAkademik->scala_score,
                'action' =>
                Html::a('<i class="fa fa-eye"></i>', ['view', 'nilai_akademik_id' => $nilaiAkademik->nilai_akademik_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                    . ' ' .
                    Html::a('<i class="fas fa-edit"></i>', ['update', 'nilai_akademik_id' => $nilaiAkademik->nilai_akademik_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update'])

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
     * Lists all NilaiAkademik models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NilaiAkademikSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NilaiAkademik model.
     * @param int $nilai_akademik_id Nilai Akademik ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nilai_akademik_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($nilai_akademik_id),
        ]);
    }

    /**
     * Creates a new NilaiAkademik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new NilaiAkademik();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nilai_akademik_id' => $model->nilai_akademik_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NilaiAkademik model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $nilai_akademik_id Nilai Akademik ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nilai_akademik_id)
    {
        $model = $this->findModel($nilai_akademik_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nilai_akademik_id' => $model->nilai_akademik_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NilaiAkademik model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $nilai_akademik_id Nilai Akademik ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nilai_akademik_id)
    {
        $this->findModel($nilai_akademik_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NilaiAkademik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $nilai_akademik_id Nilai Akademik ID
     * @return NilaiAkademik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpload()
    {
        $model = new NilaiAkademik();

        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstanceByName('NilaiAkademik[excelFile]');

            if (!$model->excelFile) {
                die("File tidak terunggah");
            }
            if ($model->validate()) {
                $filePath = Yii::getAlias('@webroot') . '/uploads/' . $model->excelFile->baseName . '.' . $model->excelFile->extension;

                $model->excelFile->saveAs($filePath);

                $spreadsheet = IOFactory::load($filePath);
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, 'A2');

                foreach ($sheetData as $row) {
                    // print_r($row);
                    // die();
                    $modelData = new NilaiAkademik();
                    $modelData->nilai_akademik_id = $row['A'];
                    $modelData->pendaftar_id = $row['B'];
                    $modelData->mat_benar = $row['C'];
                    $modelData->mat_salah = $row['D'];
                    $modelData->ing_benar = $row['E'];
                    $modelData->ing_salah = $row['F'];
                    $modelData->tpa_benar = $row['G'];
                    $modelData->tpa_salah = $row['H'];
                    $modelData->total_kosong = $row['I'];
                    $modelData->mp_tinggi = $row['J'];
                    $modelData->mp_rendah = $row['K'];
                    $modelData->perbandingan_mat_ing = $row['L'];
                    $modelData->jumlah_soal = $row['M'];
                    $modelData->hasil_score = $row['N'];
                    $modelData->scala_score = $row['O'];
                    $modelData->usulan_panitia = $row['P'];
                    $modelData->pilihan1 = $row['Q'];
                    $modelData->pilihan2 = $row['R'];
                    $modelData->pilihan3 = $row['S'];
                    $modelData->hasil_akhir_pilihan = $row['T'];

                    if (!$modelData->save()) {
                        print_r($modelData->getErrors());
                    }
                }

                unlink($filePath);
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
                die();
            }
        } else {
            return $this->render('upload', ['model' => $model]);
        }
    }

    protected function findModel($nilai_akademik_id)
    {
        if (($model = NilaiAkademik::findOne(['nilai_akademik_id' => $nilai_akademik_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
