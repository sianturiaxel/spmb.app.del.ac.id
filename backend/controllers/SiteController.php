<?php

namespace backend\controllers;

use backend\components\RbacHelper;
use backend\models\GelombangPendaftaran;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ForbiddenHttpException;
use backend\models\LoginForm;
use backend\models\Pendaftar;
use backend\models\CalonMahasiswa;
use yii\db\Query;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['lupa-password', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['admin-action'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['kaprodi-action'],
                        'allow' => true,
                        'roles' => ['kaprodi'],
                    ],
                    [
                        'actions' => ['panitia-action'],
                        'roles' => ['panitia'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function actionAdminArea()
    {
        $userId = \Yii::$app->user->id;
        if (!RbacHelper::isUserAdmin($userId)) {
            throw new \yii\web\ForbiddenHttpException('Anda tidak memiliki izin untuk melakukan aksi ini.');
        }
        // ... kode untuk admin area ...
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    public function actionIndex()

    {
        $jumlahPendaftar = Pendaftar::find()->count() ?: "0";
        $gelombangPendaftaran = Yii::$app->db->createCommand('
            SELECT t_r_gelombang_pendaftaran.gelombang_pendaftaran_id, t_r_gelombang_pendaftaran.desc,
                COUNT(t_pendaftar.gelombang_pendaftaran_id) as jumlah
            FROM t_r_gelombang_pendaftaran
            LEFT JOIN t_pendaftar ON t_pendaftar.gelombang_pendaftaran_id = t_r_gelombang_pendaftaran.gelombang_pendaftaran_id
            GROUP BY t_r_gelombang_pendaftaran.gelombang_pendaftaran_id
            ORDER BY t_r_gelombang_pendaftaran.gelombang_pendaftaran_id DESC
        ')->queryAll();

        $gelombangPendaftaran1 = (new Query())
            ->select([
                't_r_gelombang_pendaftaran.gelombang_pendaftaran_id',
                't_r_gelombang_pendaftaran.desc',
                'jumlah' => 'COUNT(t_calon_mahasiswa.pendaftar_id)'
            ])
            ->from('t_r_gelombang_pendaftaran')
            ->leftJoin('t_pendaftar', 't_pendaftar.gelombang_pendaftaran_id = t_r_gelombang_pendaftaran.gelombang_pendaftaran_id')
            ->leftJoin('t_calon_mahasiswa', 't_calon_mahasiswa.pendaftar_id = t_pendaftar.pendaftar_id')
            ->where(['or', ['status_pembayaran' => 1], ['status_pembayaran' => 0]])
            ->groupBy('t_r_gelombang_pendaftaran.gelombang_pendaftaran_id')
            ->orderBy(['t_r_gelombang_pendaftaran.gelombang_pendaftaran_id' => SORT_DESC])
            ->all(Yii::$app->db);


        $gelombangPendaftaran2 = (new Query())
            ->select([
                't_r_gelombang_pendaftaran.gelombang_pendaftaran_id',
                't_r_gelombang_pendaftaran.desc',
                'jumlah' => 'COUNT(t_calon_mahasiswa.pendaftar_id)'
            ])
            ->from('t_r_gelombang_pendaftaran')
            ->leftJoin('t_pendaftar', 't_pendaftar.gelombang_pendaftaran_id = t_r_gelombang_pendaftaran.gelombang_pendaftaran_id')
            ->leftJoin('t_calon_mahasiswa', 't_calon_mahasiswa.pendaftar_id = t_pendaftar.pendaftar_id')
            ->where(['status_pembayaran' => 1])
            ->groupBy('t_r_gelombang_pendaftaran.gelombang_pendaftaran_id')
            ->orderBy(['t_r_gelombang_pendaftaran.gelombang_pendaftaran_id' => SORT_DESC])
            ->all(Yii::$app->db);

        $jumlahCalonMahasiswaSudahBayar = CalonMahasiswa::find()
            ->where(['status_pembayaran' => 1])
            ->count();

        $jumlahCalonMahasiswaLulus = CalonMahasiswa::find()
            ->where(['or', ['status_pembayaran' => 1], ['status_pembayaran' => 0]])
            ->count();



        return $this->render('index', [
            'jumlahPendaftar' => $jumlahPendaftar,
            'gelombangPendaftaran' => $gelombangPendaftaran,
            'gelombangPendaftaran1' => $gelombangPendaftaran1,
            'gelombangPendaftaran2' => $gelombangPendaftaran2,
            'jumlahCalonMahasiswaSudahBayar' => $jumlahCalonMahasiswaSudahBayar,
            'jumlahCalonMahasiswaLulus' => $jumlahCalonMahasiswaLulus
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLupaPassword()
    {
        $this->layout = 'blank';
        return $this->render('lupapassword');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
