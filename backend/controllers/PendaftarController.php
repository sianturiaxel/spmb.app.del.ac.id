<?php

namespace backend\controllers;

use backend\models\Agama;
use backend\models\JalurPendaftaran;
use backend\models\Pendaftar;
use backend\models\PilihanJurusan;
use backend\models\CalonMahasiswa;
use backend\models\GelombangPendaftaran;
use backend\models\JenisKelamin;
use backend\models\SekolahDapodik;
use backend\models\Jurusan;
use backend\models\Kabupaten;
use backend\models\Kecamatan;
use backend\models\KodeUjian;
use backend\models\Provinsi;
use backend\models\JenjangPendidikan;
use backend\models\KemampuanBahasa;
use backend\models\MetodePembayaran;
use backend\models\Pekerjaan;
use backend\models\StatusPendaftaran;
use backend\models\finance\UserFinance;
use backend\models\finance\UserRegistrationNumber;
use backend\models\LokasiUjian;
use backend\models\PaymentDetail;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\web\UploadedFile;
use yii\base\Security;
use yii\base\InvalidParamException;
use yii\db\Exception;
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
    private function encryptId($id)
    {
        $security = new Security();
        $secretKey = 'YourComplexSecretKey123!';
        return base64_encode($security->encryptByPassword($id, $secretKey));
    }

    public function getEncryptedIdCached($pendaftar_id)
    {
        $cacheKey = 'encrypted_id_' . $pendaftar_id;
        $encrypted_id = Yii::$app->cache->get($cacheKey);

        if ($encrypted_id === false) {
            $encrypted_id = $this->encryptId($pendaftar_id);
            Yii::$app->cache->set($cacheKey, $encrypted_id, 3600);
        }

        return $encrypted_id;
    }

    private function decryptId($encrypted_id)
    {
        $security = new Security();
        $secretKey = 'YourComplexSecretKey123!';
        try {
            $id = $security->decryptByPassword(base64_decode($encrypted_id), $secretKey);
            return $id;
        } catch (\yii\base\InvalidParamException $e) {
            Yii::error("Dekripsi ID gagal: " . $e->getMessage());
            return null;
        }
    }

    public function actionDataForDatatables()
    {
        $draw = Yii::$app->request->get('draw');
        $start = Yii::$app->request->get('start');
        $length = Yii::$app->request->get('length');
        $search = Yii::$app->request->get('search', null);
        $cacheKeyTotalRecords = 'total_records_key';
        $cacheKeyTotalDisplayRecords = 'total_display_records_key_' . serialize($_GET);
        $filterAdminstrasi = Yii::$app->request->get('status_adminstrasi_id');
        $filterAkademik = Yii::$app->request->get('status_test_akademik_id');
        $filterPsikotes = Yii::$app->request->get('status_test_psikologi_id');
        $filterKelulusan = Yii::$app->request->get('status_kelulusan');
        $query = Pendaftar::find()->with(['sekolahDapodik', 'lokasi', 'kode']);
        $query->orderBy(['pendaftar_id' => SORT_DESC]);

        $totalRecords = Yii::$app->cache->get($cacheKeyTotalRecords);
        $totalDisplayRecords = Yii::$app->cache->get($cacheKeyTotalDisplayRecords);

        if ($totalRecords === false || $totalDisplayRecords === false) {
            $query = Pendaftar::find()->with(['sekolahDapodik', 'lokasi', 'kode']);
            $query->orderBy(['pendaftar_id' => SORT_DESC]);
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
            if (!empty($_GET['lokasi_ujian_id'])) {
                $query->andWhere(['lokasi_ujian_id' => $_GET['lokasi_ujian_id']]);
            }
            if (!empty($_GET['status_pendaftaran_id'])) {
                $query->andWhere(['status_pendaftaran_id' => $_GET['status_pendaftaran_id']]);
            }
            if ($search && !empty($search['value'])) {
                $query->andFilterWhere(['like', 'nama', $search['value']]);
            }
            if ($totalRecords === false) {
                $totalRecords = $query->count();
                Yii::$app->cache->set($cacheKeyTotalRecords, $totalRecords, 3600); // Cache selama 1 jam
            }
            if ($totalDisplayRecords === false) {
                $totalDisplayRecords = $query->count();
                Yii::$app->cache->set($cacheKeyTotalDisplayRecords, $totalDisplayRecords, 3600); // Cache selama 1 jam
            }
        }

        $data = $query->offset($start)->limit($length)->all();
        $dataArray = [];
        $buttonKelulusanDiklik = Yii::$app->request->post('buttonKelulusanDiklik', true);
        $no = $start + 1;
        foreach ($data as $pendaftar) {
            $encrypted_id = $this->getEncryptedIdCached($pendaftar->pendaftar_id);
            $actionButtons = Html::a('<i class="fa fa-eye"></i>', ['view', 'pendaftar_id' => $encrypted_id], ['class' => 'btn btn-primary btn-xs', 'title' => 'View'])
                . ' ' .
                Html::a('<i class="fas fa-edit"></i>', ['update', 'pendaftar_id' => $encrypted_id], ['class' => 'btn btn-info btn-xs', 'title' => 'Update']);

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
                'no' => $no++,
                'pendaftar_id' => $this->getEncryptedIdCached($pendaftar->pendaftar_id),
                'no_pendaftaran' => $pendaftar->prefix_kode_pendaftaran . $pendaftar->no_pendaftaran,
                'nama_pendaftar' => $pendaftar->nama,
                'nama_sekolah' => $pendaftar->sekolahDapodik ? $pendaftar->sekolahDapodik->sekolah : 'Tidak ditemukan',
                'lokasi_ujian' => $pendaftar->lokasi ? $pendaftar->lokasi->alamat : 'Tidak ditemukan',
                'kode_ujian' => $pendaftar->kode ? $pendaftar->kode->kode_ujian : 'Tidak ditemukan',
                'status_pendaftaran' => $pendaftar->status_pendaftaran_id,
                'action' => $actionButtons,
                'checkbox' => $pendaftar->status_kelulusan === '0'
                    ? '<input type="checkbox" name="selected[]" value="' . $pendaftar->pendaftar_id . '">'
                    : '',
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

    public function actionKodeUjianWawancara()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $encryptedIds = Yii::$app->request->post('ids', []);
        if (empty($encryptedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada pendaftar yang dipilih.'];
        }

        $decryptedIds = array_map(function ($encrypted_id) {
            return $this->decryptId($encrypted_id);
        }, $encryptedIds);

        $decryptedIds = array_filter($decryptedIds, function ($id) {
            return $id !== null;
        });

        if (empty($decryptedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Dekripsi ID gagal.'];
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $affectedRows = 0;
            $tidakTersediaCount = 0;

            foreach ($decryptedIds as $id) {
                $pendaftar = Pendaftar::findOne(['pendaftar_id' => $id]);
                if ($pendaftar !== null) {
                    $kodeUjianId = $this->pilihKodeUjianWawancara($pendaftar->gelombang_pendaftaran_id);
                    if ($kodeUjianId !== null) {
                        $pendaftar->kode_ujian_id = $kodeUjianId;
                        if ($pendaftar->save()) {
                            $affectedRows++;
                        }
                    } else {
                        $tidakTersediaCount++;
                    }
                }
            }

            $transaction->commit();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($affectedRows === 0 && $tidakTersediaCount > 0) {
                return ['success' => false, 'message' => "Tidak ada kode ujian yang tersedia untuk {$tidakTersediaCount} pendaftar."];
            }

            $message = "Kode Ujian berhasil diassign. Terpengaruh: {$affectedRows} baris.";
            if ($tidakTersediaCount > 0) {
                $message .= " Tidak ada kode ujian yang tersedia untuk {$tidakTersediaCount} pendaftar.";
            }

            return ['success' => true, 'message' => $message];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return ['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function actionKodeUjianPsikotes()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $encryptedIds = Yii::$app->request->post('ids', []);
        if (empty($encryptedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada pendaftar yang dipilih.'];
        }

        $decryptedIds = array_map(function ($encrypted_id) {
            return $this->decryptId($encrypted_id);
        }, $encryptedIds);

        $decryptedIds = array_filter($decryptedIds, function ($id) {
            return $id !== null;
        });

        if (empty($decryptedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Dekripsi ID gagal.'];
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $affectedRows = 0;
            $tidakTersediaCount = 0;

            foreach ($decryptedIds as $id) {
                $pendaftar = Pendaftar::findOne(['pendaftar_id' => $id]);
                if ($pendaftar !== null) {
                    $kodeUjianId = $this->pilihKodeUjianPsikotes($pendaftar->gelombang_pendaftaran_id);
                    if ($kodeUjianId !== null) {
                        $pendaftar->kode_ujian_id = $kodeUjianId;
                        if ($pendaftar->save()) {
                            $affectedRows++;
                        }
                    } else {
                        $tidakTersediaCount++;
                    }
                }
            }

            $transaction->commit();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($affectedRows === 0 && $tidakTersediaCount > 0) {
                return ['success' => false, 'message' => "Tidak ada kode ujian yang tersedia untuk {$tidakTersediaCount} pendaftar."];
            }

            $message = "Kode Ujian berhasil diassign. Terpengaruh: {$affectedRows} baris.";
            if ($tidakTersediaCount > 0) {
                $message .= " Tidak ada kode ujian yang tersedia untuk {$tidakTersediaCount} pendaftar.";
            }

            return ['success' => true, 'message' => $message];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return ['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    private function pilihKodeUjianWawancara($gelombangPendaftaranId)
    {
        $kodeUjianTersedia = KodeUjian::find()
            ->select(['kode_ujian_id'])
            ->where(['jenis_test_id' => 1, 'gelombang_pendaftaran_id' => $gelombangPendaftaranId, 'status' => 1])
            ->andWhere(['NOT IN', 'kode_ujian_id', Pendaftar::find()->select('kode_ujian_id')->column()])
            ->orderBy(['kode_ujian_id' => SORT_ASC])
            ->one();

        return $kodeUjianTersedia ? $kodeUjianTersedia->kode_ujian_id : null;
    }
    private function pilihKodeUjianPsikotes($gelombangPendaftaranId)
    {
        $kodeUjianTersedia = KodeUjian::find()
            ->select(['kode_ujian_id'])
            ->where(['jenis_test_id' => 2, 'gelombang_pendaftaran_id' => $gelombangPendaftaranId, 'status' => 1])
            ->andWhere(['NOT IN', 'kode_ujian_id', Pendaftar::find()->select('kode_ujian_id')->column()])
            ->orderBy(['kode_ujian_id' => SORT_ASC])
            ->one();

        return $kodeUjianTersedia ? $kodeUjianTersedia->kode_ujian_id : null;
    }

    public function actionLulusAdminstrasi()
    {
        Yii::info('Data POST: ' . print_r(Yii::$app->request->post(), true));
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $encryptedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang terenkripsi diterima untuk update: " . print_r($encryptedIds, true));

        $decryptedIds = array_map(function ($encrypted_id) {
            return $this->decryptId($encrypted_id);
        }, $encryptedIds);

        $decryptedIds = array_filter($decryptedIds, function ($id) {
            return $id !== null;
        });

        if (empty($decryptedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada ID yang valid untuk pemrosesan.'];
        }

        $affectedRows = Pendaftar::updateAll(['status_adminstrasi_id' => 1], ['pendaftar_id' => $decryptedIds]);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'success' => true,
            'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris."
        ];
    }

    public function actionLulusAkademik()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $encryptedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang terenkripsi diterima untuk update: " . print_r($encryptedIds, true));

        $decryptedIds = array_map(function ($encrypted_id) {
            return $this->decryptId($encrypted_id);
        }, $encryptedIds);

        $decryptedIds = array_filter($decryptedIds, function ($id) {
            return $id !== null;
        });

        if (empty($decryptedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada ID yang valid untuk pemrosesan.'];
        }

        $affectedRows = Pendaftar::updateAll(['status_test_akademik_id' => 1], ['pendaftar_id' => $decryptedIds]);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'success' => true,
            'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris."
        ];
    }

    public function actionLulusPsikotes()
    {
        Yii::info('Data POST: ' . print_r(Yii::$app->request->post(), true));
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $encryptedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang terenkripsi diterima untuk update: " . print_r($encryptedIds, true));

        $decryptedIds = array_map(function ($encrypted_id) {
            return $this->decryptId($encrypted_id);
        }, $encryptedIds);

        $decryptedIds = array_filter($decryptedIds, function ($id) {
            return $id !== null;
        });

        if (empty($decryptedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada ID yang valid untuk pemrosesan.'];
        }

        $affectedRows = Pendaftar::updateAll(['status_test_psikologi_id' => 1], ['pendaftar_id' => $decryptedIds]);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'success' => true,
            'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris."
        ];
    }

    public function actionLulusWawancara()
    {
        Yii::info('Data POST: ' . print_r(Yii::$app->request->post(), true));
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $encryptedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang terenkripsi diterima untuk update: " . print_r($encryptedIds, true));

        $decryptedIds = array_map(function ($encrypted_id) {
            return $this->decryptId($encrypted_id);
        }, $encryptedIds);

        $decryptedIds = array_filter($decryptedIds, function ($id) {
            return $id !== null;
        });

        if (empty($decryptedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada ID yang valid untuk pemrosesan.'];
        }

        $affectedRows = Pendaftar::updateAll(['status_wawancara_id' => 1], ['pendaftar_id' => $decryptedIds]);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'success' => true,
            'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris."
        ];
    }

    public function actionKelulusan()
    {
        Yii::info('Data POST: ' . print_r(Yii::$app->request->post(), true));
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Invalid request');
        }

        $encryptedIds = Yii::$app->request->post('ids', []);
        Yii::info("IDs yang terenkripsi diterima untuk update: " . print_r($encryptedIds, true));

        $decryptedIds = array_map(function ($encrypted_id) {
            return $this->decryptId($encrypted_id);
        }, $encryptedIds);

        $decryptedIds = array_filter($decryptedIds, function ($id) {
            return $id !== null;
        });

        if (empty($decryptedIds)) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => false, 'message' => 'Tidak ada ID yang valid untuk pemrosesan.'];
        }

        $affectedRows = Pendaftar::updateAll(['status_kelulusan' => 1], ['pendaftar_id' => $decryptedIds]);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'success' => true,
            'message' => "Status berhasil diupdate. Terpengaruh: {$affectedRows} baris."
        ];
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

    // public function actionDataCalonMahasiswa($pendaftar_id)
    // {
    //     $pendaftar = Pendaftar::findOne($pendaftar_id);

    //     if (!$pendaftar) {
    //         Yii::error("Pendaftar dengan ID $pendaftar_id tidak ditemukan.");
    //         return false;
    //     }
    //     $pilihanJurusanLulus = PilihanJurusan::find()
    //         ->where(['pendaftar_id' => $pendaftar_id, 'lulus' => 1])
    //         ->one();
    //     if (!$pilihanJurusanLulus) {
    //         Yii::error("Tidak ada jurusan yang lulus untuk pendaftar ID $pendaftar_id.");
    //         return false;
    //     }

    //     //Virtual Account
    //     $va = NULL;
    //     $userFinance = NULL;

    //     if (!is_null($pendaftar->virtual_account) && !empty($pendaftar->virtual_account)) {
    //         $va = $pendaftar->virtual_account;
    //         $userFinance = UserRegistrationNumber::updateDataProdi($pilihanJurusanLulus->jurusan_id, $va);
    //     } else {
    //         $va = CalonMahasiswa::generateVa($pendaftar_id);
    //         $userFinance = UserFinance::createUser($pendaftar_id, $va);
    //     }

    //     $calonMahasiswa = new CalonMahasiswa();
    //     $calonMahasiswa->pendaftar_id = $pendaftar->pendaftar_id;
    //     $calonMahasiswa->jalur_pendaftaran_id = $pendaftar->jalur_pendaftaran_id;
    //     $calonMahasiswa->user_id = $pendaftar->user_id;
    //     $calonMahasiswa->nama = $pendaftar->nama;
    //     $calonMahasiswa->nik = $pendaftar->nik;
    //     $calonMahasiswa->nisn = $pendaftar->nisn;
    //     $calonMahasiswa->no_kps = $pendaftar->no_kps;
    //     $calonMahasiswa->jenis_kelamin_id = $pendaftar->jenis_kelamin_id;
    //     $calonMahasiswa->tempat_lahir = $pendaftar->tempat_lahir;
    //     $calonMahasiswa->no_telepon_rumah = $pendaftar->no_telepon_rumah;
    //     //$calonMahasiswa->golongan_darah_id = $pendaftar->golongan_darah_id;
    //     $calonMahasiswa->jurusan_id = $pilihanJurusanLulus->jurusan_id;

    //     $calonMahasiswa->tanggal_lahir = $pendaftar->tanggal_lahir;
    //     $calonMahasiswa->agama_id = $pendaftar->agama_id;
    //     $calonMahasiswa->alamat = $pendaftar->alamat;
    //     $calonMahasiswa->alamat_kec = $pendaftar->alamat_kec;
    //     $calonMahasiswa->alamat_kab = $pendaftar->alamat_kab;
    //     $calonMahasiswa->alamat_prov = $pendaftar->alamat_prov;
    //     $calonMahasiswa->kode_pos = $pendaftar->kode_pos;
    //     $calonMahasiswa->kelurahan = $pendaftar->kelurahan;
    //     $calonMahasiswa->alamat_kec = $pendaftar->alamat_kec;
    //     $calonMahasiswa->no_telepon_mobile = $pendaftar->no_telepon_mobile;
    //     $calonMahasiswa->email = $pendaftar->email;
    //     $calonMahasiswa->tanggal_lahir_ayah = $pendaftar->tanggal_lahir_ayah;
    //     $calonMahasiswa->tanggal_lahir_ibu = $pendaftar->tanggal_lahir_ibu;
    //     $calonMahasiswa->nama_ibu_kandung = $pendaftar->nama_ibu_kandung;
    //     $calonMahasiswa->nama_ayah_kandung = $pendaftar->nama_ayah_kandung;
    //     $calonMahasiswa->nik_ayah = $pendaftar->nik_ayah;
    //     $calonMahasiswa->nik_ibu = $pendaftar->nik_ibu;
    //     $calonMahasiswa->pendidikan_ayah_id = $pendaftar->pendidikan_ayah_id;
    //     $calonMahasiswa->pendidikan_ibu_id = $pendaftar->pendidikan_ibu_id;
    //     $calonMahasiswa->alamat_orang_tua = $pendaftar->alamat_orang_tua;
    //     $calonMahasiswa->alamat_kec_orangtua = $pendaftar->alamat_kec_orangtua;
    //     $calonMahasiswa->alamat_kab_orangtua = $pendaftar->alamat_kab_orangtua;
    //     $calonMahasiswa->alamat_prov_orangtua = $pendaftar->alamat_prov_orangtua;
    //     $calonMahasiswa->kode_pos_orang_tua = $pendaftar->kode_pos_orang_tua;
    //     $calonMahasiswa->pekerjaan_ayah_id = $pendaftar->pekerjaan_ayah_id;
    //     $calonMahasiswa->pekerjaan_ibu_id = $pendaftar->pekerjaan_ibu_id;
    //     $calonMahasiswa->penghasilan_ayah = $pendaftar->penghasilan_ayah;
    //     $calonMahasiswa->penghasilan_ibu = $pendaftar->penghasilan_ibu;
    //     $calonMahasiswa->penghasilan_total = $pendaftar->penghasilan_total;
    //     $calonMahasiswa->no_hp_orangtua = $pendaftar->no_hp_orangtua;
    //     // $calonMahasiswa->no_telepon_mobile_ayah = $pendaftar->no_telepon_mobile_ayah;
    //     // $calonMahasiswa->no_telepon_mobile_ibu = $pendaftar->no_telepon_mobile_ibu;
    //     $calonMahasiswa->sekolah_id = $pendaftar->sekolah_id;
    //     $calonMahasiswa->sekolah_dapodik_id = $pendaftar->sekolah_dapodik_id;
    //     $calonMahasiswa->jurusan_sekolah = $pendaftar->jurusan_sekolah;
    //     $calonMahasiswa->jurusan_sekolah_id = $pendaftar->jurusan_sekolah_id;
    //     $calonMahasiswa->pas_foto = $pendaftar->pas_foto;
    //     $calonMahasiswa->virtual_account_number = $pendaftar->virtual_account;

    //     // var_dump($calonMahasiswa);
    //     // die();

    //     $calonMahasiswa->virtual_account_number = $va;
    //     $calonMahasiswa->bank_name = 'Bank Mandiri';
    //     $calonMahasiswa->n = $pendaftar->n;


    //     if ($calonMahasiswa->save()) {
    //         $updateCalonMahasiswa = $calonMahasiswa;
    //         //Tagihan Daftar Ulang
    //         if ($userFinance != NULL) {
    //             $cekTagihan = \Yii::$app->runAction('payment/cek-tagihan-penulang', ['calon_mahasiswa_id' => $calonMahasiswa->calon_mahasiswa_id]);
    //             $result = json_decode($cekTagihan);
    //             if (isset($result->status) && strtolower($result->status) === 'success' && isset($result->user_id)) {
    //                 // disini populate from spmb
    //                 $payment = \Yii::$app->runAction('payment/generate-tagihan-penulang', ['userId' => $result->user_id, 'calonMahasiswaId' => $calonMahasiswa->calon_mahasiswa_id]);
    //                 //IF SUCCESS GENERATE TAGIHAN
    //                 if ($payment) {
    //                     $updateCalonMahasiswa->total_pembayaran = $payment->total_amount_paid;
    //                     if ($updateCalonMahasiswa->save()) {
    //                         foreach ($payment->paymentDetails as $pd) {
    //                             $paymentDetailSpmb = new PaymentDetail();
    //                             $paymentDetailSpmb->calon_mahasiswa_id = $calonMahasiswa->calon_mahasiswa_id;
    //                             $paymentDetailSpmb->total_amount = $pd->total_amount_paid;
    //                             $paymentDetailSpmb->fee_name = $pd->fee->name;
    //                             $paymentDetailSpmb->save();
    //                         }
    //                         Yii::info("Data pendaftar ID $pendaftar_id berhasil disalin ke calon mahasiswa.");
    //                         return true;
    //                     }
    //                 } else {
    //                     return false;
    //                 }
    //             } else {
    //                 return false;
    //             }
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         Yii::error("Gagal menyimpan calon mahasiswa: " . json_encode($calonMahasiswa->getErrors()));
    //         return false;
    //     }
    // }
    public function actionDataCalonMahasiswa($pendaftar_id)
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

        // Virtual Account
        $va = null;
        $userFinance = null;

        if (!empty($pendaftar->virtual_account)) {
            $va = $pendaftar->virtual_account;
            $userFinance = UserRegistrationNumber::updateDataProdi($pilihanJurusanLulus->jurusan_id, $va);
        } else {
            $va = CalonMahasiswa::generateVa($pendaftar_id);
            $userFinance = UserFinance::createUser($pendaftar_id, $va);
        }

        $calonMahasiswa = new CalonMahasiswa();
        $calonMahasiswa->pendaftar_id = $pendaftar->pendaftar_id;
        $calonMahasiswa->jalur_pendaftaran_id = $pendaftar->jalur_pendaftaran_id;
        $calonMahasiswa->user_id = $pendaftar->user_id;
        $calonMahasiswa->nama = $pendaftar->nama;
        $calonMahasiswa->nik = $pendaftar->nik;
        $calonMahasiswa->nisn = $pendaftar->nisn;
        $calonMahasiswa->no_kps = $pendaftar->no_kps;
        $calonMahasiswa->jenis_kelamin_id = $pendaftar->jenis_kelamin_id;
        $calonMahasiswa->tempat_lahir = $pendaftar->tempat_lahir;
        $calonMahasiswa->no_telepon_rumah = $pendaftar->no_telepon_rumah;
        //$calonMahasiswa->golongan_darah_id = $pendaftar->golongan_darah_id;
        $calonMahasiswa->jurusan_id = $pilihanJurusanLulus->jurusan_id;

        $calonMahasiswa->tanggal_lahir = $pendaftar->tanggal_lahir;
        $calonMahasiswa->agama_id = $pendaftar->agama_id;
        $calonMahasiswa->alamat = $pendaftar->alamat;
        $calonMahasiswa->alamat_kec = $pendaftar->alamat_kec;
        $calonMahasiswa->alamat_kab = $pendaftar->alamat_kab;
        $calonMahasiswa->alamat_prov = $pendaftar->alamat_prov;
        $calonMahasiswa->kode_pos = $pendaftar->kode_pos;
        $calonMahasiswa->kelurahan = $pendaftar->kelurahan;
        $calonMahasiswa->alamat_kec = $pendaftar->alamat_kec;
        $calonMahasiswa->no_telepon_mobile = $pendaftar->no_telepon_mobile;
        $calonMahasiswa->email = $pendaftar->email;
        $calonMahasiswa->tanggal_lahir_ayah = $pendaftar->tanggal_lahir_ayah;
        $calonMahasiswa->tanggal_lahir_ibu = $pendaftar->tanggal_lahir_ibu;
        $calonMahasiswa->nama_ibu_kandung = $pendaftar->nama_ibu_kandung;
        $calonMahasiswa->nama_ayah_kandung = $pendaftar->nama_ayah_kandung;
        $calonMahasiswa->nik_ayah = $pendaftar->nik_ayah;
        $calonMahasiswa->nik_ibu = $pendaftar->nik_ibu;
        $calonMahasiswa->pendidikan_ayah_id = $pendaftar->pendidikan_ayah_id;
        $calonMahasiswa->pendidikan_ibu_id = $pendaftar->pendidikan_ibu_id;
        $calonMahasiswa->alamat_orang_tua = $pendaftar->alamat_orang_tua;
        $calonMahasiswa->alamat_kec_orangtua = $pendaftar->alamat_kec_orangtua;
        $calonMahasiswa->alamat_kab_orangtua = $pendaftar->alamat_kab_orangtua;
        $calonMahasiswa->alamat_prov_orangtua = $pendaftar->alamat_prov_orangtua;
        $calonMahasiswa->kode_pos_orang_tua = $pendaftar->kode_pos_orang_tua;
        $calonMahasiswa->pekerjaan_ayah_id = $pendaftar->pekerjaan_ayah_id;
        $calonMahasiswa->pekerjaan_ibu_id = $pendaftar->pekerjaan_ibu_id;
        $calonMahasiswa->penghasilan_ayah = $pendaftar->penghasilan_ayah;
        $calonMahasiswa->penghasilan_ibu = $pendaftar->penghasilan_ibu;
        $calonMahasiswa->penghasilan_total = $pendaftar->penghasilan_total;
        $calonMahasiswa->no_hp_orangtua = $pendaftar->no_hp_orangtua;
        // $calonMahasiswa->no_telepon_mobile_ayah = $pendaftar->no_telepon_mobile_ayah;
        // $calonMahasiswa->no_telepon_mobile_ibu = $pendaftar->no_telepon_mobile_ibu;
        $calonMahasiswa->sekolah_id = $pendaftar->sekolah_id;
        $calonMahasiswa->sekolah_dapodik_id = $pendaftar->sekolah_dapodik_id;
        $calonMahasiswa->jurusan_sekolah = $pendaftar->jurusan_sekolah;
        $calonMahasiswa->jurusan_sekolah_id = $pendaftar->jurusan_sekolah_id;
        $calonMahasiswa->pas_foto = $pendaftar->pas_foto;
        $calonMahasiswa->virtual_account_number = $pendaftar->virtual_account;

        // var_dump($calonMahasiswa);
        // die();

        $calonMahasiswa->virtual_account_number = $va;
        $calonMahasiswa->bank_name = 'Bank Mandiri';
        $calonMahasiswa->n = $pendaftar->n;

        if ($calonMahasiswa->save()) {
            $updateCalonMahasiswa = $calonMahasiswa;
            //Tagihan Daftar Ulang
            if ($userFinance != NULL) {
                $cekTagihan = \Yii::$app->runAction('payment/cek-tagihan-penulang', ['calon_mahasiswa_id' => $calonMahasiswa->calon_mahasiswa_id]);
                $result = json_decode($cekTagihan);
                if (isset($result->status) && strtolower($result->status) === 'success' && isset($result->user_id)) {
                    // disini populate from spmb
                    $payment = \Yii::$app->runAction('payment/generate-tagihan-penulang', ['userId' => $result->user_id, 'calonMahasiswaId' => $calonMahasiswa->calon_mahasiswa_id]);
                    //IF SUCCESS GENERATE TAGIHAN
                    if ($payment) {
                        $updateCalonMahasiswa->total_pembayaran = $payment->total_amount_paid;
                        if ($updateCalonMahasiswa->save()) {
                            foreach ($payment->paymentDetails as $pd) {
                                $paymentDetailSpmb = new PaymentDetail();
                                $paymentDetailSpmb->calon_mahasiswa_id = $calonMahasiswa->calon_mahasiswa_id;
                                $paymentDetailSpmb->total_amount = $pd->total_amount_paid;
                                $paymentDetailSpmb->fee_name = $pd->fee->name;
                                $paymentDetailSpmb->save();
                            }
                            Yii::info("Data pendaftar ID $pendaftar_id berhasil disalin ke calon mahasiswa.");
                            return true;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            Yii::error("Gagal menyimpan calon mahasiswa: " . json_encode($calonMahasiswa->getErrors()));
            return false;
        }
    }


    public function actionIndex()
    {
        $jalurPendaftaran = JalurPendaftaran::find()->all();
        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();
        $lokasi = LokasiUjian::find()
            ->orderBy(['lokasi_ujian_id' => SORT_DESC])
            ->all();

        $statusPendaftaran = StatusPendaftaran::find()
            ->orderBy(['status_pendaftaran_id' => SORT_DESC])
            ->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Pendaftar::find(),

        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'jalurPendaftaran' => $jalurPendaftaran,
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'lokasi' => $lokasi,
            'statusPendaftaran' => $statusPendaftaran,
        ]);
    }

    public function actionView($pendaftar_id)
    {

        $security = new Security();
        $secretKey = 'YourComplexSecretKey123!';

        try {
            $pendaftar_id = $security->decryptByPassword(base64_decode($pendaftar_id), $secretKey);


            if ($pendaftar_id) {
                $model = Pendaftar::findOne($pendaftar_id);
                if ($model !== null) {
                    return $this->render('view', ['model' => $model]);
                } else {
                    throw new NotFoundHttpException('Pendaftar tidak ditemukan.');
                }
            } else {
                throw new InvalidParamException('Parameter tidak valid.');
            }
        } catch (\Exception $e) {
            Yii::error("Error saat dekripsi: " . $e->getMessage()); // Tambahkan ini untuk logging error
            throw new InvalidParamException('Terjadi kesalahan dalam proses dekripsi.');
        }
    }

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

    public function actionUpdate($pendaftar_id)
    {
        $security = new Security();
        $secretKey = 'YourComplexSecretKey123!';
        $gelombangPendaftaran = GelombangPendaftaran::find()
            ->orderBy(['gelombang_pendaftaran_id' => SORT_DESC])
            ->all();
        $jenisKelamin = JenisKelamin::find()->asArray()->all();
        $agama = Agama::find()->asArray()->all();
        $kecamatan = Kecamatan::find()->asArray()->all();
        $kabupaten = Kabupaten::find()->asArray()->all();
        $provinsi = Provinsi::find()->asArray()->all();
        $kecamatanOrangtua = Kecamatan::find()->asArray()->all();
        $kabupatenOrangtua = Kabupaten::find()->asArray()->all();
        $provinsiOrangtua = Provinsi::find()->asArray()->all();
        $pendidikanAyah = JenjangPendidikan::find()->asArray()->all();
        $pendidikanIbu = JenjangPendidikan::find()->asArray()->all();
        $pekerjaanAyah = Pekerjaan::find()->asArray()->all();
        $pekerjaanIbu = Pekerjaan::find()->asArray()->all();
        $sekolahDapodik = SekolahDapodik::find()->asArray()->all();
        $kemampuanBahasaInggris = KemampuanBahasa::find()->asArray()->all();
        $kemampuanBahasaAsing = KemampuanBahasa::find()->asArray()->all();
        $metodePembayaran = MetodePembayaran::find()->asArray()->all();
        $statusPendaftaran = StatusPendaftaran::find()->asArray()->all();
        // var_dump($kecamatan);
        // die();

        try {
            $pendaftar_id = $security->decryptByPassword(base64_decode($pendaftar_id), $secretKey);
            $model = $this->findModel($pendaftar_id);

            if ($this->request->isPost) {
                Yii::info("Data POST: " . print_r(Yii::$app->request->post(), true), __METHOD__);

                if ($model->load(Yii::$app->request->post())) {
                    $model->fileFoto = UploadedFile::getInstance($model, 'fileFoto');
                    $model->fileNilaiRapor = UploadedFile::getInstance($model, 'fileNilaiRapor');
                    $model->fileSertifikat = UploadedFile::getInstance($model, 'fileSertifikat');
                    $model->fileFormulir = UploadedFile::getInstance($model, 'fileFormulir');
                    $model->fileRekomendasi = UploadedFile::getInstance($model, 'fileRekomendasi');
                    $isUploadSuccessful = true;

                    if ($model->fileFoto && !$model->fileFoto->getHasError()) {
                        $filePath = Yii::getAlias('@webroot') . '/uploads/' . $model->fileFoto->baseName . '.' . $model->fileFoto->extension;
                        $isUploadSuccessful &= $model->fileFoto->saveAs($filePath);
                        $model->pas_foto = $model->fileFoto->baseName . '.' . $model->fileFoto->extension;
                    }

                    if ($model->fileNilaiRapor && !$model->fileNilaiRapor->getHasError()) {
                        $filePath = Yii::getAlias('@webroot') . '/uploads/' . $model->fileNilaiRapor->baseName . '.' . $model->fileNilaiRapor->extension;
                        $isUploadSuccessful &= $model->fileNilaiRapor->saveAs($filePath);
                        $model->file_nilai_rapor = $model->fileNilaiRapor->baseName . '.' . $model->fileNilaiRapor->extension;
                    }
                    if ($model->fileSertifikat && !$model->fileSertifikat->getHasError()) {
                        $filePath = Yii::getAlias('@webroot') . '/uploads/' . $model->fileSertifikat->baseName . '.' . $model->fileSertifikat->extension;
                        $isUploadSuccessful &= $model->fileSertifikat->saveAs($filePath);
                        $model->file_sertifikat = $model->fileSertifikat->baseName . '.' . $model->fileSertifikat->extension;
                    }
                    if ($model->fileFormulir && !$model->fileFormulir->getHasError()) {
                        $filePath = Yii::getAlias('@webroot') . '/uploads/' . $model->fileFormulir->baseName . '.' . $model->fileFormulir->extension;
                        $isUploadSuccessful &= $model->fileFormulir->saveAs($filePath);
                        $model->file_formulir = $model->fileFormulir->baseName . '.' . $model->fileFormulir->extension;
                    }
                    if ($model->fileRekomendasi && !$model->fileRekomendasi->getHasError()) {
                        $filePath = Yii::getAlias('@webroot') . '/uploads/' . $model->fileRekomendasi->baseName . '.' . $model->fileRekomendasi->extension;
                        $isUploadSuccessful &= $model->fileRekomendasi->saveAs($filePath);
                        $model->file_rekomendasi = $model->fileRekomendasi->baseName . '.' . $model->fileRekomendasi->extension;
                    }
                }

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    $encrypted_id = base64_encode($security->encryptByPassword($model->pendaftar_id, $secretKey));
                    return $this->redirect(['index', 'pendaftar_id' => $encrypted_id]);
                } else {
                    Yii::error("Error saat menyimpan: " . print_r($model->getErrors(), true), __METHOD__);
                }
            }


            return $this->render('update', [
                'model' => $model,
                'gelombangPendaftaran' => $gelombangPendaftaran,
                'jenisKelamin' => $jenisKelamin,
                'agama' => $agama,
                'kecamatan' => $kecamatan,
                'kabupaten' => $kabupaten,
                'provinsi' => $provinsi,
                'kecamatanOrangtua' => $kecamatanOrangtua,
                'kabupatenOrangtua' => $kabupatenOrangtua,
                'provinsiOrangtua' => $provinsiOrangtua,
                'pendidikanAyah' => $pendidikanAyah,
                'pendidikanIbu' => $pendidikanIbu,
                'pekerjaanAyah' => $pekerjaanAyah,
                'pekerjaanIbu' => $pekerjaanIbu,
                'sekolahDapodik' => $sekolahDapodik,
                'kemampuanBahasaInggris' => $kemampuanBahasaInggris,
                'kemampuanBahasaAsing' => $kemampuanBahasaAsing,
                'metodePembayaran' => $metodePembayaran,
                'statusPendaftaran' => $statusPendaftaran,


            ]);
        } catch (\Exception $e) {
            Yii::error("Exception: " . $e->getMessage(), __METHOD__);
            throw new InvalidParamException('Parameter tidak valid: ' . $e->getMessage());
        }
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
                $calonMahasiswa = $this->actionDataCalonMahasiswa($pendaftarId);
                if ($calonMahasiswa) {
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

    public function actionDelete($pendaftar_id)
    {
        $this->findModel($pendaftar_id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($pendaftar_id)
    {
        if (($model = Pendaftar::findOne($pendaftar_id)) !== null) {
            return $model;
        } else {
            Yii::error("Model tidak ditemukan dengan ID: $pendaftar_id", __METHOD__);
            throw new NotFoundHttpException('Model tidak ditemukan.');
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            $gelombangPendaftaran = GelombangPendaftaran::findOne($this->gelombang_pendaftaran_id);
            if ($gelombangPendaftaran !== null) {
                $gelombangPendaftaran->updateCounters(['counter' => 1]);
            }
        }
    }
}
