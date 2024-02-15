<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\JurusanSekolah $model */
/** @var yii\widgets\ActiveForm $form */
$js = <<<JS
$(document).ready(function() {

    $(".select2").select2({
        width: '100%' 
    });
});
JS;
$this->registerJs($js);
?>




<div class="jenjang-pendidikan-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'isactive')->dropDownList(
                        [1 => 'Aktif', 0 => 'Tidak Aktif'],
                        ['class' => 'select2', 'prompt' => 'Pilih status']
                    ) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'tingkat')->dropDownList(['SMA' => 'SMA', 'SMK' => 'SMK', 'MA' => 'MA',], ['prompt' => '']) ?>
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

    }

    .input-group .form-control,
    .input-group .input-group-append {
        height: 38px;
    }

    .input-group {
        width: 100%;
    }
</style>