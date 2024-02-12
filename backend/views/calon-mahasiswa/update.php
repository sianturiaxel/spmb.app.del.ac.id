<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CalonMahasiswa $model */

$this->title = 'Update Calon Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Calon Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="calon-mahasiswa-update">
    <?= $this->render('_form', [
        'model' => $model,
        //'gelombangPendaftaran' => $gelombangPendaftaran,
        'golonganDarah' => $golonganDarah,
        'jenisKelamin' => $jenisKelamin,
        'agama' => $agama,
        'kecamatan' => $kecamatan,
        'kabupaten' => $kabupaten,
        'provinsi' => $provinsi,
        'pendidikanAyah' => $pendidikanAyah,
        'pendidikanIbu' => $pendidikanIbu,
        'kecamatanOrangtua' => $kecamatanOrangtua,
        'kabupatenOrangtua' => $kabupatenOrangtua,
        'provinsiOrangtua' => $provinsiOrangtua,
        'pekerjaanAyah' => $pekerjaanAyah,
        'pekerjaanIbu' => $pekerjaanIbu,
        'sekolahDapodik' => $sekolahDapodik,
        'kemampuanBahasaInggris' => $kemampuanBahasaInggris,
        'kemampuanBahasaAsing' => $kemampuanBahasaAsing,
        'metodePembayaran' => $metodePembayaran,
        'statusPendaftaran' => $statusPendaftaran,
        'paymentDetail' => $paymentDetail,
    ]) ?>

</div>