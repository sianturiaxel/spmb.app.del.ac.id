<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CalonMahasiswaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="calon-mahasiswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'calon_mahasiswa_id') ?>

    <?= $form->field($model, 'pendaftar_id') ?>

    <?= $form->field($model, 'jalur_pendaftaran_id') ?>

    <?= $form->field($model, 'cis_imported') ?>

    <?= $form->field($model, 'jurusan_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'nik') ?>

    <?php // echo $form->field($model, 'nisn') ?>

    <?php // echo $form->field($model, 'no_kps') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'jenis_kelamin_id') ?>

    <?php // echo $form->field($model, 'golongan_darah_id') ?>

    <?php // echo $form->field($model, 'tanggal_lahir') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'agama_id') ?>

    <?php // echo $form->field($model, 'anak_ke') ?>

    <?php // echo $form->field($model, 'jumlah_bersaudara') ?>

    <?php // echo $form->field($model, 'jumlah_tanggungan_ortu') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'kode_pos') ?>

    <?php // echo $form->field($model, 'kelurahan') ?>

    <?php // echo $form->field($model, 'alamat_kec') ?>

    <?php // echo $form->field($model, 'alamat_kab') ?>

    <?php // echo $form->field($model, 'alamat_prov') ?>

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

    <?php // echo $form->field($model, 'alamat_orang_tua') ?>

    <?php // echo $form->field($model, 'kode_pos_orang_tua') ?>

    <?php // echo $form->field($model, 'alamat_kec_orangtua') ?>

    <?php // echo $form->field($model, 'alamat_kab_orangtua') ?>

    <?php // echo $form->field($model, 'alamat_prov_orangtua') ?>

    <?php // echo $form->field($model, 'pekerjaan_ayah_id') ?>

    <?php // echo $form->field($model, 'pekerjaan_ibu_id') ?>

    <?php // echo $form->field($model, 'penghasilan_ayah_id') ?>

    <?php // echo $form->field($model, 'penghasilan_ibu_id') ?>

    <?php // echo $form->field($model, 'penghasilan_ayah') ?>

    <?php // echo $form->field($model, 'penghasilan_ibu') ?>

    <?php // echo $form->field($model, 'penghasilan_total') ?>

    <?php // echo $form->field($model, 'no_telepon_mobile_ayah') ?>

    <?php // echo $form->field($model, 'no_telepon_mobile_ibu') ?>

    <?php // echo $form->field($model, 'nama_wali') ?>

    <?php // echo $form->field($model, 'nik_wali') ?>

    <?php // echo $form->field($model, 'no_hp_wali') ?>

    <?php // echo $form->field($model, 'pekerjaan_wali_id') ?>

    <?php // echo $form->field($model, 'penghasilan_wali') ?>

    <?php // echo $form->field($model, 'alamat_wali') ?>

    <?php // echo $form->field($model, 'sekolah_id') ?>

    <?php // echo $form->field($model, 'jurusan_sekolah') ?>

    <?php // echo $form->field($model, 'akreditasi_sekolah') ?>

    <?php // echo $form->field($model, 'npwp') ?>

    <?php // echo $form->field($model, 'kebutuhan_khusus_mahasiswa') ?>

    <?php // echo $form->field($model, 'informasi_del_id') ?>

    <?php // echo $form->field($model, 'informasi_del_lainnya') ?>

    <?php // echo $form->field($model, 'n') ?>

    <?php // echo $form->field($model, 'nim') ?>

    <?php // echo $form->field($model, 'tanggal_pendaftaran') ?>

    <?php // echo $form->field($model, 'status_pembayaran') ?>

    <?php // echo $form->field($model, 'total_pembayaran') ?>

    <?php // echo $form->field($model, 'virtual_account_number') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'pas_foto') ?>

    <?php // echo $form->field($model, 'berkas_pendaftaran_ulang') ?>

    <?php // echo $form->field($model, 'jurusan_sekolah_id') ?>

    <?php // echo $form->field($model, 'sekolah_dapodik_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 't_payment_detail') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
