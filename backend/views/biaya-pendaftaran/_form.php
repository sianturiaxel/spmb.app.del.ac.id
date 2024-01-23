<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BiayaPendaftaran $model */
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




<div class="biaya-pendaftaran-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label" for="gelombang-pendaftaran-select">Gelombang Pendaftaran</label>
                    <select class="form-control select2" id="gelombang-pendaftaran-select" name="BiayaPendaftaran[gelombang_pendaftaran_id]">
                        <option value="">Pilih Gelombang Pendaftaran</option>
                        <?php foreach ($gelombangPendaftaran as $gelombang) : ?>
                            <option value="<?= Html::encode($gelombang['gelombang_pendaftaran_id']); ?>" <?= $model->gelombang_pendaftaran_id == $gelombang['gelombang_pendaftaran_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($gelombang['desc']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="fee-id-select">Fee</label>
                    <select class="form-control select2" id="fee-id-select" name="BiayaPendaftaran[fee_id]">
                        <option value="">Pilih Fee</option>
                        <?php foreach ($feeId as $fee) : ?>
                            <option value="<?= Html::encode($fee['fee_id']); ?>" <?= $model->fee_id == $fee['fee_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($fee['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'biaya_daftar')->textInput(['maxlength' => true])->label('Biaya Pendaftaran') ?>
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