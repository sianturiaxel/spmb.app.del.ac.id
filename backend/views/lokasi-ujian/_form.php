<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\LokasiUjian $model */
/** @var yii\widgets\ActiveForm $form */
$js = <<<JS
$(document).ready(function() {
    $(".select2").select2({       
        width: '100%' // Atur lebar Select2      
    });
});
JS;
$this->registerJs($js);
?>

<div class="voucher-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label" for="gelombang-pendaftaran-select">Gelombang Pendaftaran</label>
                    <select class="form-control select2" id="gelombang-pendaftaran-select" name="LokasiUjian[gelombang_pendaftaran_id]">
                        <option value="">Pilih Gelombang Pendaftaran</option>
                        <?php foreach ($gelombangPendaftaran as $gelombang) : ?>
                            <option value="<?= Html::encode($gelombang['gelombang_pendaftaran_id']); ?>" <?= $model->gelombang_pendaftaran_id == $gelombang['gelombang_pendaftaran_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($gelombang['desc']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="jenis-test-select">Jenis Test</label>
                    <select class="form-control select2" id="jenis-test-select" name="LokasiUjian[jenis_test_id]">
                        <option value="">Pilih Jenis Tes</option>
                        <?php foreach ($jenisTest as $jenis) : ?>
                            <option value="<?= Html::encode($jenis['jenis_test_id']); ?>" <?= $model->jenis_test_id == $jenis['jenis_test_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($jenis['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'kode_lokasi')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'gedung')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'tanggal_mulai')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'tanggal_selesai')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'is_active')->dropDownList(
                        [1 => 'Aktif', 0 => 'Tidak Aktif'],
                        ['class' => 'select2', 'prompt' => 'Pilih status']
                    ) ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <?= Html::button('Kembali', ['class' => 'btn btn-warning', 'onclick' => 'history.go(-1)']) ?>

                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>


<style>
    .select2-container--default .select2-selection--single {
        height: auto;
        /* Atau nilai lain yang sesuai dengan form lain */
    }
</style>