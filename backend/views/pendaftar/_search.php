<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PendaftarSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pendaftar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pendaftar_id') ?>

    <?= $form->field($model, 'jalur_pendaftaran_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'nik') ?>

    <?= $form->field($model, 'nisn') ?>

    <?php // echo $form->field($model, 'penerima_kps') ?>

    <?php // echo $form->field($model, 'no_kps') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'jenis_kelamin_id') ?>

    <?php // echo $form->field($model, 'tanggal_lahir') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'agama_id') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'kode_pos') ?>

    <?php // echo $form->field($model, 'kelurahan') ?>

    <?php // echo $form->field($model, 'kecamatan_id') ?>

    <?php // echo $form->field($model, 'kabupaten_id') ?>

    <?php // echo $form->field($model, 'provinsi_id') ?>

    <?php // echo $form->field($model, 'kewarganegaraan_id') ?>

    <?php // echo $form->field($model, 'no_telepon_rumah') ?>

    <?php // echo $form->field($model, 'no_telepon_mobile') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'nama_ayah_kandung') ?>

    <?php // echo $form->field($model, 'nama_ibu_kandung') ?>

    <?php // echo $form->field($model, 'nik_ayah') ?>

    <?php // echo $form->field($model, 'nik_ibu') ?>

    <?php // echo $form->field($model, 'tanggal_lahir_ayah') ?>

    <?php // echo $form->field($model, 'tanggal_lahir_ibu') ?>

    <?php // echo $form->field($model, 'pendidikan_ayah_id') ?>

    <?php // echo $form->field($model, 'pendidikan_ibu_id') ?>

    <?php // echo $form->field($model, 'alamat_kec_orangtua') ?>

    <?php // echo $form->field($model, 'alamat_kab_orangtua') ?>

    <?php // echo $form->field($model, 'alamat_prov_orangtua') ?>

    <?php // echo $form->field($model, 'alamat_orang_tua') ?>

    <?php // echo $form->field($model, 'kode_pos_orang_tua') ?>

    <?php // echo $form->field($model, 'pekerjaan_ayah_id') ?>

    <?php // echo $form->field($model, 'pekerjaan_ibu_id') ?>

    <?php // echo $form->field($model, 'penghasilan_ayah') ?>

    <?php // echo $form->field($model, 'penghasilan_ibu') ?>

    <?php // echo $form->field($model, 'penghasilan_total') ?>

    <?php // echo $form->field($model, 'sekolah_id') ?>

    <?php // echo $form->field($model, 'jurusan_sekolah') ?>

    <?php // echo $form->field($model, 'akreditasi_sekolah') ?>

    <?php // echo $form->field($model, 'npwp') ?>

    <?php // echo $form->field($model, 'kebutuhan_khusus_mahasiswa') ?>

    <?php // echo $form->field($model, 'kemampuan_bahasa_inggris') ?>

    <?php // echo $form->field($model, 'bahasa_asing_lainnya') ?>

    <?php // echo $form->field($model, 'kemampuan_bahasa_asing_lainnya') ?>

    <?php // echo $form->field($model, 'informasi_del_id') ?>

    <?php // echo $form->field($model, 'informasi_del_lainnya') ?>

    <?php // echo $form->field($model, 'n') ?>

    <?php // echo $form->field($model, 'tanggal_pendaftaran') ?>

    <?php // echo $form->field($model, 'metode_pembayaran_id') ?>

    <?php // echo $form->field($model, 'file_verifikasi_pembayaran') ?>

    <?php // echo $form->field($model, 'pas_foto') ?>

    <?php // echo $form->field($model, 'file_nilai_rapor') ?>

    <?php // echo $form->field($model, 'file_sertifikat') ?>

    <?php // echo $form->field($model, 'file_formulir') ?>

    <?php // echo $form->field($model, 'file_rekomendasi') ?>

    <?php // echo $form->field($model, 'prefix_kode_pendaftaran') ?>

    <?php // echo $form->field($model, 'no_pendaftaran') ?>

    <?php // echo $form->field($model, 'status_pendaftaran_id') ?>

    <?php // echo $form->field($model, 'status_adminstrasi_id') ?>

    <?php // echo $form->field($model, 'status_test_akademik_id') ?>

    <?php // echo $form->field($model, 'status_test_psikologi_id') ?>

    <?php // echo $form->field($model, 'status_kelulusan') ?>

    <?php // echo $form->field($model, 'gelombang_pendaftaran_id') ?>

    <?php // echo $form->field($model, 'lokasi_ujian_id') ?>

    <?php // echo $form->field($model, 'kode_ujian_id') ?>

    <?php // echo $form->field($model, 'jurusan_sekolah_id') ?>

    <?php // echo $form->field($model, 'sekolah_dapodik_id') ?>

    <?php // echo $form->field($model, 'no_hp_orangtua') ?>

    <?php // echo $form->field($model, 'motivasi') ?>

    <?php // echo $form->field($model, 'hobby') ?>

    <?php // echo $form->field($model, 'kab_domisili') ?>

    <?php // echo $form->field($model, 'virtual_account') ?>

    <?php // echo $form->field($model, 'voucher_daftar') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
