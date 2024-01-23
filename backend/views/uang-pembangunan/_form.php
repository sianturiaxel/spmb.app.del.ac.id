<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UangPembangunan $model */
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


<div class="uang-pembangunan-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" for="gelombang-pendaftaran-select">Gelombang Pendaftaran</label>
                    <select class="form-control select2" id="gelombang-pendaftaran-select" name="UangPembangunan[gelombang_pendaftaran_id]">
                        <option value="">Pilih Gelombang Pendaftaran</option>
                        <?php foreach ($gelombangPendaftaran as $gelombang) : ?>
                            <option value="<?= Html::encode($gelombang['gelombang_pendaftaran_id']); ?>" <?= $model->gelombang_pendaftaran_id == $gelombang['gelombang_pendaftaran_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($gelombang['desc']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="jurusan-id-select">Jurusan</label>
                    <select class="form-control select2" id="jurusan-id-select" name="UangPembangunan[jurusan_id]">
                        <option value="">Pilih Jurusan</option>
                        <?php foreach ($jurusan as $jurusan) : ?>
                            <option value="<?= Html::encode($jurusan['jurusan_id']); ?>" <?= $model->jurusan_id == $jurusan['jurusan_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($jurusan['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'minimum_n')->textInput(['maxlength' => true])->label('Minimum N') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'base_n')->textInput(['maxlength' => true])->label('Base N') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'multi_n')->textInput(['maxlength' => true])->label('Multi N') ?>
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