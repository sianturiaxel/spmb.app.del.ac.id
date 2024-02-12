<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PaymentDetail $model */
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
<div class="payment-detail-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label" for="calon-mahasiswa-select">Calon Mahasiswa</label>
                    <select class="form-control select2" id="calon-mahasiswa-select" name="PaymentDetail[calon_mahasiswa_id]" <?= $model->isNewRecord ? '' : 'disabled' ?>>
                        <option value="">Pilih Calon Mahasiswa</option>
                        <?php foreach ($calonMahasiswa as $mahasiswa) : ?>
                            <option value="<?= Html::encode($mahasiswa['calon_mahasiswa_id']); ?>" <?= $model->calon_mahasiswa_id == $mahasiswa['calon_mahasiswa_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($mahasiswa['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'fee_name')->textInput(['maxlength' => true]) ?>
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