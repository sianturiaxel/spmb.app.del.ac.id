<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CalonMahasiswa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="calon-mahasiswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pendaftar_id')->textInput() ?>

    <?= $form->field($model, 'jalur_pendaftaran_id')->textInput() ?>

    <?= $form->field($model, 'cis_imported')->textInput() ?>

    <?= $form->field($model, 'jurusan_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nisn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_kps')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin_id')->textInput() ?>

    <?= $form->field($model, 'golongan_darah_id')->textInput() ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agama_id')->textInput() ?>

    <?= $form->field($model, 'anak_ke')->textInput() ?>

    <?= $form->field($model, 'jumlah_bersaudara')->textInput() ?>

    <?= $form->field($model, 'jumlah_tanggungan_ortu')->textInput() ?>

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

    <?= $form->field($model, 'alamat_orang_tua')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kode_pos_orang_tua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_kec_orangtua')->textInput() ?>

    <?= $form->field($model, 'alamat_kab_orangtua')->textInput() ?>

    <?= $form->field($model, 'alamat_prov_orangtua')->textInput() ?>

    <?= $form->field($model, 'pekerjaan_ayah_id')->textInput() ?>

    <?= $form->field($model, 'pekerjaan_ibu_id')->textInput() ?>

    <?= $form->field($model, 'penghasilan_ayah_id')->textInput() ?>

    <?= $form->field($model, 'penghasilan_ibu_id')->textInput() ?>

    <?= $form->field($model, 'penghasilan_ayah')->textInput() ?>

    <?= $form->field($model, 'penghasilan_ibu')->textInput() ?>

    <?= $form->field($model, 'penghasilan_total')->textInput() ?>

    <?= $form->field($model, 'no_telepon_mobile_ayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_telepon_mobile_ibu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_wali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik_wali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_hp_wali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pekerjaan_wali_id')->textInput() ?>

    <?= $form->field($model, 'penghasilan_wali')->textInput() ?>

    <?= $form->field($model, 'alamat_wali')->textInput() ?>

    <?= $form->field($model, 'sekolah_id')->textInput() ?>

    <?= $form->field($model, 'jurusan_sekolah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'akreditasi_sekolah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npwp')->textInput() ?>

    <?= $form->field($model, 'kebutuhan_khusus_mahasiswa')->textInput() ?>

    <?= $form->field($model, 'informasi_del_id')->textInput() ?>

    <?= $form->field($model, 'informasi_del_lainnya')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'n')->textInput() ?>

    <?= $form->field($model, 'nim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_pendaftaran')->textInput() ?>

    <?= $form->field($model, 'status_pembayaran')->textInput() ?>

    <?= $form->field($model, 'total_pembayaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'virtual_account_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pas_foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'berkas_pendaftaran_ulang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jurusan_sekolah_id')->textInput() ?>

    <?= $form->field($model, 'sekolah_dapodik_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 't_payment_detail')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
