<?php

namespace backend\controllers;

use backend\models\JalurPendaftaran;
use backend\models\Pendaftar;
use backend\models\PilihanJurusan;
use backend\models\CalonMahasiswa;
use backend\models\GelombangPendaftaran;
use backend\models\Jurusan;
use backend\models\KodeUjian;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\helpers\Json;
use yii\web\Response;

use yii;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

/**
 * PendaftarController implements the CRUD actions for Pendaftar model.
 */
class PendaftarController extends Controller
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
        $search = Yii::$app->request->get('search', null);
        $filterAdminstrasi = Yii::$app->request->get('status_adminstrasi_id');
        $filterAkademik = Yii::$app->request->get('status_test_akademik_id');
        $filterPsikotes = Yii::$app->request->get('status_test_psikologi_id');
        $filterKelulusan = Yii::$app->request->get('status_kelulusan');
        $query = Pendaftar::find()->with(['sekolah', 'lokasi', 'kode']);

        $totalRecords = $query->count();
        if ($filterAdminstrasi !== null && $filterAdminstrasi !== '') {
            $query->andWhere(['status_adminstrasi_id' => $filterAdminstrasi]);
        }
        if ($filterAkademik !== null && $filterAkademik !== '') {
            $query->andWhere(['status_test_akademik_id' => $filterAkademik]);
        }
        if ($filterPsikotes !== null && $filterPsikotes !== '') {
            $query->andWhere(['status_test_psikologi_id' => $filterPsikotes]);
        }
        if (in_array($filterKelulusan, ['0', '1'])) {
            $query->andWhere(['status_kelulusan' => $filterKelulusan]);
        }
        if (isset($_GET['status_wawancara_id']) && $_GET['status_wawancara_id'] != '') {
            $query->andWhere(['status_wawancara_id' => $_GET['status_wawancara_id']]);
        }
        if (!empty($_GET['jalur_pendaftaran_id'])) {
            $query->andWhere(['jalur_pendaftaran_id' => $_GET['jalur_pendaftaran_id']]);
        }
        if (!empty($_GET['gelombang_pendaftaran_id'])) {
            $query->andWhere(['gelombang_pendaftaran_id' => $_GET['gelombang_pendaftaran_id']]);
        }
        if ($search && !empty($search['value'])) {
            $query->andFilterWhere(['like', 'nama', $search['value']]);
        }
        $totalDisplayRecords = $query->count();
        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];
        $buttonKelulusanDiklik = Yii::$app->request->post('buttonKelulusanDiklik', true);
        foreach ($data as $pendaftar) {
            $actionButtons = Html::a('<i class="fa fa-eye"></i>', ['view', 'pendaftar_id' => $pendaftar->pendaftar_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                . ' ' .
                Html::a('<i class="fas fa-edit"></i>', ['update', 'pendaftar_id' => $pendaftar->pendaftar_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update']);

            $lulusDiPilihanJurusan = PilihanJurusan::find()
                ->where(['pendaftar_id' => $pendaftar->pendaftar_id, 'lulus' => 1])
                ->exists();
            // var_dump($lulusDiPilihanJurusan);
            // die();

            if ($buttonKelulusanDiklik && $pendaftar->status_kelulusan == 1) {
                $lulusDiPilihanJurusan = PilihanJurusan::find()
                    ->where(['pendaftar_id' => $pendaftar->pendaftar_id, 'lulus' => 1])
                    ->exists();

                if ($lulusDiPilihanJurusan) {
                    $iconClass = 'fas fa-clipboard-check text-warning';
                    $title = 'Sudah Lulus';
                } else {
                    $iconClass = 'far fa-clipboard';
                    $title = 'Luluskan';
                }

                $actionButtons .= ' ' . Html::a('<i class="' . $iconClass . '"></i>', '#detailJurusan', [
                    'class' => 'btn btn-success btn-xs ' . ($lulusDiPilihanJurusan ? 'lulus-pada-jurusan' : 'luluskan-button'),
                    'title' => $title,
                    'data-toggle' => 'modal',
                    'data-target' => '#luluskanModal',
                    'data-pendaftar-id' => $pendaftar->pendaftar_id
                ]);
            }
            $dataArray[] = [
                'no' => $pendaftar->pendaftar_id,
                'no_pendaftaran' => $pendaftar->prefix_kode_pendaftaran . $pendaftar->no_pendaftaran,
                'nama_pendaftar' => $pendaftar->nama,
                'nama_sekolah' => $pendaftar->sekolah ? $pendaftar->sekolah->nama : 'Tidak ditemukan',
                'lokasi_ujian' => $pendaftar->lokasi ? $pendaftar->lokasi->alamat : 'Tidak ditemukan',
                'kode_ujian' => $pendaftar->kode ? $pendaftar->kode->kode_ujian : 'Tidak ditemukan',
                'action' => $actionButtons,
                'checkbox' => '<input type="checkbox" name="selected[]" value="' . $pendaftar->pendaftar_id . '">',
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

    public function actionLuluskanSemua()
    {
        if (!Yii::$app->request->isPost) {
            return $this->redirect(['index']);
        }

        $affectedRows = Pendaftar::updateAll(['status_adminstrasi_id' => 1], 'status_adminstrasi_id = 0');

        if ($affectedRows > 0) {
            $selectedPendaftars = Pendaftar::find()->where(['status_adminstrasi_id' => 1])->all();

            foreach ($selectedPendaftars as $pendaftar) {
                if ($pendaftar->status_adminstrasi_id == 1) {
                    $pendaftar->kode_ujian_id = $this->getKodeUjianId();
                    $pendaftar->save(false);
                }
            }
        }

        Yii::$app->session->setFlash('success', "Jumlah data yang diluluskan: {$affectedRows}");

        return $this->redirect(['index']);
    }

    public function actionKodeUjian()
    {
        Yii::info('Data POST: ' . print_r(Yii::$app->request->post(), true));
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $selectedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang diterima untuk update: " . print_r($selectedIds, true));

        if (empty($selectedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada pendaftar yang dipilih.'];
        }

        $affectedRows = 0;

        foreach ($selectedIds as $idPendaftar) {
            Yii::info("Memproses pendaftar dengan ID: $idPendaftar");

            $kodeUjian = KodeUjian::find()
                ->where(['NOT IN', 'kode_ujian_id', Pendaftar::find()->select('kode_ujian_id')->andWhere(['is not', 'kode_ujian_id', null])->column()])
                ->one();

            if ($kodeUjian) {
                Yii::info("Kode Ujian ditemukan: " . print_r($kodeUjian->attributes, true));

                $pendaftar = Pendaftar::findOne($idPendaftar);
                if ($pendaftar) {
                    Yii::info("Pendaftar ditemukan: " . print_r($pendaftar->attributes, true));
                    $pendaftar->kode_ujian_id = $kodeUjian->kode_ujian_id;

                    if ($pendaftar->save()) {
                        $affectedRows++;
                        Yii::info("Kode Ujian berhasil di-assign ke pendaftar: $idPendaftar");
                    } else {
                        Yii::error("Gagal menyimpan pendaftar: $idPendaftar. Errors: " . print_r($pendaftar->getErrors(), true));
                    }
                } else {
                    Yii::error("Pendaftar tidak ditemukan dengan ID: $idPendaftar");
                }
            } else {
                Yii::info("Tidak ada kode ujian yang tersedia untuk diassign.");
                break; // Keluar dari loop jika tidak ada kode ujian yang tersedia
            }
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($affectedRows > 0) {
            return ['success' => true, 'message' => "Kode Ujian berhasil diassign. Terpengaruh: {$affectedRows} baris."];
        } else {
            return ['success' => false, 'message' => 'Tidak ada kode ujian yang tersedia untuk diassign.'];
        }
    }





    public function actionLulusAdminstrasi()

    {
        Yii::info('Data POST: ' . print_r(Yii::$app->request->post(), true));
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $selectedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang diterima untuk update: " . print_r($selectedIds, true));

        if (!empty($selectedIds)) {
            $affectedRows = Pendaftar::updateAll(['status_adminstrasi_id' => 1], ['pendaftar_id' => $selectedIds]);

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true, 'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris. Kode Ujian diperbarui."];
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada pendaftar yang dipilih.'];
        }
    }

    public function actionLulusAkademik()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $selectedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang diterima untuk update: " . print_r($selectedIds, true));

        if (!empty($selectedIds)) {
            $affectedRows = Pendaftar::updateAll(['status_test_akademik_id' => 1], ['pendaftar_id' => $selectedIds]);

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true, 'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris. Kode Ujian diperbarui."];
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada pendaftar yang dipilih.'];
        }
    }


    public function actionLulusPsikotes()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $selectedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang diterima untuk update: " . print_r($selectedIds, true));

        if (!empty($selectedIds)) {
            $affectedRows = Pendaftar::updateAll(['status_test_psikologi_id' => 1], ['pendaftar_id' => $selectedIds]);

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true, 'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris. Kode Ujian diperbarui."];
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada pendaftar yang dipilih.'];
        }
    }

    public function actionLulusWawancara()
    {

        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $selectedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang diterima untuk update: " . print_r($selectedIds, true));

        if (!empty($selectedIds)) {
            $affectedRows = Pendaftar::updateAll(['status_wawancara_id' => 1], ['pendaftar_id' => $selectedIds]);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true, 'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris. Kode Ujian diperbarui."];
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada pendaftar yang dipilih.'];
        }
    }

    public function actionKelulusan()
    {

        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $selectedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang diterima untuk update: " . print_r($selectedIds, true));


        if (!empty($selectedIds)) {
            $affectedRows = Pendaftar::updateAll(['status_kelulusan' => 1], ['pendaftar_id' => $selectedIds]);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true, 'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris. Kode Ujian diperbarui."];
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada pendaftar yang dipilih.'];
        }
    }



    public function actionExportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        // Tambahkan header lainnya sesuai dengan struktur tabel Pendaftar Anda

        // Ambil data dari database
        $pendaftarList = Pendaftar::find()->where(['status_adminstrasi_id' => 1])->all();
        if (empty($pendaftarList)) {
            // Jika tidak ada data, kirimkan pesan error atau tangani sesuai kebutuhan
            return "Tidak ada data untuk diexport.";
        }

        // Isi data
        $row = 2;
        foreach ($pendaftarList as $pendaftar) {
            $sheet->setCellValue('A' . $row, $pendaftar->pendaftar_id);
            $sheet->setCellValue('B' . $row, $pendaftar->nama);
            // ... isi data lainnya ...
            $row++;
        }
        // Mengatur header response untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_pendaftar.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data-Pendaftar.xlsx';

        // Mengatur header response
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/vnd.ms-excel');
        Yii::$app->response->headers->add('Content-Disposition', 'attachment; filename="' . $filename . '"');

        // Menyimpan ke output stream
        ob_start();
        $writer->save('php://output');
        $excelOutput = ob_get_clean();

        return $excelOutput;
    }

    public function actionAdminstrasiStatus()
    {
        // Kode untuk mengambil data dengan status_adminstrasi_id = 0
        $data = Pendaftar::find()->where(['status_adminstrasi_id' => 0])->asArray()->all();

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'data' => $data
        ];
    }

    private function actionDataCalonMahasiswa($pendaftar_id)
    {
        $pendaftar = Pendaftar::findOne($pendaftar_id);
        if (!$pendaftar) {
            Yii::error("Pendaftar dengan ID $pendaftar_id tidak ditemukan.");
            return false;
        }
        $pilihanJurusanLulus = PilihanJurusan::find()
            ->where(['pendaftar_id' => $pendaftar_id, 'lulus' => 1])
            ->one();
        if (!$pilihanJurusanLulus) {
            Yii::error("Tidak ada jurusan yang lulus untuk pendaftar ID $pendaftar_id.");
            return false;
        }

        $calonMahasiswa = new CalonMahasiswa();
        $calonMahasiswa->pendaftar_id = $pendaftar->pendaftar_id;
        $calonMahasiswa->jalur_pendaftaran_id = $pendaftar->jalur_pendaftaran_id;
        $calonMahasiswa->user_id = $pendaftar->user_id;
        $calonMahasiswa->nama = $pendaftar->nama;
        $calonMahasiswa->nik = $pendaftar->nik;
        $calonMahasiswa->jurusan_id = $pilihanJurusanLulus->jurusan_id;



        // var_dump($calonMahasiswa);
        // die();

        if ($calonMahasiswa->save()) {
            Yii::info("Data pendaftar ID $pendaftar_id berhasil disalin ke calon mahasiswa.");
            return true;
        } else {
            Yii::error("Gagal menyimpan calon mahasiswa: " . json_encode($calonMahasiswa->getErrors()));
            return false;
        }
    }

    /**
     * Lists all Pendaftar models.
     *
     * @return string
     */

    public function actionIndex()
    {
        $jalurPendaftaran = JalurPendaftaran::find()->all();
        $gelombangPendaftaran = GelombangPendaftaran::find()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Pendaftar::find(),

        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'jalurPendaftaran' => $jalurPendaftaran,
            'gelombangPendaftaran' => $gelombangPendaftaran,
        ]);
    }

    /**
     * Displays a single Pendaftar model.
     * @param int $pendaftar_id Pendaftar ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($pendaftar_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($pendaftar_id),
        ]);
    }
    /**
     * Creates a new Pendaftar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pendaftar();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'pendaftar_id' => $model->pendaftar_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pendaftar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $pendaftar_id Pendaftar ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($pendaftar_id)
    {
        $model = $this->findModel($pendaftar_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pendaftar_id' => $model->pendaftar_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionGetPilihanJurusan($pendaftar_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $pilihanJurusan = PilihanJurusan::find()
            ->with(['jurusan', 'pendaftar'])
            ->where(['pendaftar_id' => $pendaftar_id])
            ->orderBy('prioritas')
            ->all();

        $responseData = [];
        foreach ($pilihanJurusan as $pilihan) {
            $responseData[] = [
                'idJurusan' => $pilihan->jurusan_id,
                'namaJurusan' => $pilihan->jurusan->nama,
                'namaPendaftar' => $pilihan->pendaftar->nama,
                'nikPendaftar' => $pilihan->pendaftar->nik,
                'prioritas' => $pilihan->prioritas,
                'lulus' => $pilihan->lulus,
            ];
        }

        return ['pilihanJurusan' => $responseData];
    }
    public function actionUpdateLulus()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $pendaftarId = Yii::$app->request->post('pendaftar_id');
        $jurusanId = Yii::$app->request->post('jurusan_id');

        if (!$pendaftarId || !$jurusanId) {
            return ['success' => false, 'error' => 'Missing parameters'];
        }

        $pilihanJurusan = PilihanJurusan::find()
            ->where(['pendaftar_id' => $pendaftarId, 'jurusan_id' => $jurusanId])
            ->one();

        if ($pilihanJurusan) {
            $pilihanJurusan->lulus = 1;
            if ($pilihanJurusan->save()) {
                // Memanggil fungsi untuk menyalin data ke t_calon_mahasiswa
                if ($this->actionDataCalonMahasiswa($pendaftarId)) {
                    return ['success' => true, 'message' => 'Data berhasil disimpan dan disalin ke calon mahasiswa.'];
                } else {
                    return ['success' => false, 'error' => 'Data disimpan tetapi gagal menyalin ke calon mahasiswa.'];
                }
            } else {
                Yii::error("Error saat menyimpan: " . json_encode($pilihanJurusan->getErrors()));
                return ['success' => false, 'error' => 'Error saat menyimpan: ' . json_encode($pilihanJurusan->getErrors())];
            }
        }
        return ['success' => false, 'error' => 'Pilihan Jurusan tidak ditemukan'];
    }


    public function actionLulusJurusan($pendaftar_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $pilihanJurusan = PilihanJurusan::find()
            ->with(['jurusan', 'pendaftar'])
            ->where(['pendaftar_id' => $pendaftar_id])
            ->orderBy('prioritas')
            ->all();

        $responseData = [];
        foreach ($pilihanJurusan as $pilihan) {
            $responseData[] = [
                'pendaftar_id' => $pilihan->pendaftar_id,
                'idJurusan' => $pilihan->jurusan_id,
                'namaJurusan' => $pilihan->jurusan->nama,
                'namaPendaftar' => $pilihan->pendaftar->nama,
                'nikPendaftar' => $pilihan->pendaftar->nik,
                'prioritas' => $pilihan->prioritas,
                'lulus' => $pilihan->lulus,
            ];
        }

        return ['pilihanJurusan' => $responseData];
    }


    public function actionDownloadKartu($pendaftar_id, $print = null)
    {
        $pendaftar = Pendaftar::findOne($pendaftar_id);
        if (!$pendaftar) {
            throw new NotFoundHttpException("Pendaftar tidak ditemukan.");
        }

        $pilihanJurusan = PilihanJurusan::find()
            ->with(['jurusan', 'pendaftar'])
            ->where(['pendaftar_id' => $pendaftar_id])
            ->orderBy('prioritas')
            ->all();

        $pilihan1 = $pilihan2 = $pilihan3 = null;
        foreach ($pilihanJurusan as $pilihan) {
            if ($pilihan->prioritas == 1) {
                $pilihan1 = $pilihan;
            } elseif ($pilihan->prioritas == 2) {
                $pilihan2 = $pilihan;
            } elseif ($pilihan->prioritas == 3) {
                $pilihan3 = $pilihan;
            }
        }

        return $this->render('kartu_ujian', [
            'model' => $pendaftar,
            'autoPrint' => true,
            'pilihan1' => $pilihan1,
            'pilihan2' => $pilihan2,
            'pilihan3' => $pilihan3,
        ]);
    }


    /**
     * Deletes an existing Pendaftar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $pendaftar_id Pendaftar ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($pendaftar_id)
    {
        $this->findModel($pendaftar_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pendaftar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $pendaftar_id Pendaftar ID
     * @return Pendaftar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($pendaftar_id)
    {
        if (($model = Pendaftar::findOne(['pendaftar_id' => $pendaftar_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
