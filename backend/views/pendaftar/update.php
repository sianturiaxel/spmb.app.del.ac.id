<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Pendaftar $model */

$this->title = 'Update Pendaftar';
$this->params['breadcrumbs'][] = ['label' => 'Pendaftar', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pendaftar-update">

        <?= $this->render('_form', [
                'model' => $model,
                'gelombangPendaftaran' => $gelombangPendaftaran,
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
        ]) ?>

</div>