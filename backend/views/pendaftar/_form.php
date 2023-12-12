<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Pendaftar $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pendaftar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jalur_pendaftaran_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nisn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'penerima_kps')->textInput() ?>

    <?= $form->field($model, 'no_kps')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin_id')->textInput() ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agama_id')->textInput() ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kode_pos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelurahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_kec')->textInput() ?>

    <?= $form->field($model, 'alamat_kab')->textInput() ?>

    <?= $form->field($model, 'alamat_prov')->textInput() ?>

    <?= $form->field($model, 'kewarganegaraan_id')->textInput() ?>

    <?= $form->field($model, 'no_telepon_rumah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_telepon_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_ayah_kandung')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_ibu_kandung')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik_ayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik_ibu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir_ayah')->textInput() ?>

    <?= $form->field($model, 'tanggal_lahir_ibu')->textInput() ?>

    <?= $form->field($model, 'pendidikan_ayah_id')->textInput() ?>

    <?= $form->field($model, 'pendidikan_ibu_id')->textInput() ?>

    <?= $form->field($model, 'alamat_kec_orangtua')->textInput() ?>

    <?= $form->field($model, 'alamat_kab_orangtua')->textInput() ?>

    <?= $form->field($model, 'alamat_prov_orangtua')->textInput() ?>

    <?= $form->field($model, 'alamat_orang_tua')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kode_pos_orang_tua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pekerjaan_ayah_id')->textInput() ?>

    <?= $form->field($model, 'pekerjaan_ibu_id')->textInput() ?>

    <?= $form->field($model, 'penghasilan_ayah')->textInput() ?>

    <?= $form->field($model, 'penghasilan_ibu')->textInput() ?>

    <?= $form->field($model, 'penghasilan_total')->textInput() ?>

    <?= $form->field($model, 'sekolah_id')->textInput() ?>

    <?= $form->field($model, 'jurusan_sekolah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'akreditasi_sekolah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npwp')->textInput() ?>

    <?= $form->field($model, 'kebutuhan_khusus_mahasiswa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kemampuan_bahasa_inggris')->textInput() ?>

    <?= $form->field($model, 'bahasa_asing_lainnya')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kemampuan_bahasa_asing_lainnya')->textInput() ?>

    <?= $form->field($model, 'informasi_del_id')->textInput() ?>

    <?= $form->field($model, 'informasi_del_lainnya')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'n')->textInput() ?>

    <?= $form->field($model, 'tanggal_pendaftaran')->textInput() ?>

    <?= $form->field($model, 'metode_pembayaran_id')->textInput() ?>

    <?= $form->field($model, 'file_verifikasi_pembayaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pas_foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_nilai_rapor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_sertifikat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_formulir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_rekomendasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prefix_kode_pendaftaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_pendaftaran')->textInput() ?>

    <?= $form->field($model, 'status_pendaftaran_id')->textInput() ?>

    <?= $form->field($model, 'status_adminstrasi_id')->textInput() ?>

    <?= $form->field($model, 'status_test_akademik_id')->textInput() ?>

    <?= $form->field($model, 'status_test_psikologi_id')->textInput() ?>

    <?= $form->field($model, 'status_kelulusan')->textInput() ?>

    <?= $form->field($model, 'gelombang_pendaftaran_id')->textInput() ?>

    <?= $form->field($model, 'lokasi_ujian_id')->textInput() ?>

    <?= $form->field($model, 'kode_ujian_id')->textInput() ?>

    <?= $form->field($model, 'jurusan_sekolah_id')->textInput() ?>

    <?= $form->field($model, 'sekolah_dapodik_id')->textInput() ?>

    <?= $form->field($model, 'no_hp_orangtua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'motivasi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hobby')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kab_domisili')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'virtual_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'voucher_daftar')->textInput(['maxlength' => true]) ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>