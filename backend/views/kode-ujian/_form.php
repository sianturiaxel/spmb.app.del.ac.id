<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\KodeUjian $model */
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

<div class="kode-ujian-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label" for="gelombang-pendaftaran-select">Gelombang Pendaftaran</label>
                    <select class="form-control select2" id="gelombang-pendaftaran-select" name="KodeUjian[gelombang_pendaftaran_id]">
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
                    <select class="form-control select2" id="jenis-test-select" name="KodeUjian[jenis_test_id]">
                        <option value="">Pilih Jenis Tes</option>
                        <?php foreach ($jenisTest as $test) : ?>
                            <option value="<?= Html::encode($test['jenis_test_id']); ?>" <?= $model->jenis_test_id == $test['jenis_test_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($test['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'kode_ujian')->textInput(['maxlength' => true])->label('Kode Ujian') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
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