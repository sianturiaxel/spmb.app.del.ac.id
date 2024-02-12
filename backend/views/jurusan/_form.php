<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Jurusan $model */
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

<div class="jurusan-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label" for="fakultas-select">Fakultas</label>
                    <select class="form-control select2" id="fakultas-select" name="Jurusan[fakultas_id]">
                        <option value="">Fakultas</option>
                        <?php foreach ($fakultas as $fakultas) : ?>
                            <option value="<?= Html::encode($fakultas['fakultas_id']); ?>" <?= $model->fakultas_id == $fakultas['fakultas_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($fakultas['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'prefix_nim')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'counter_nim')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'status_active')->dropDownList(
                        [1 => 'Aktif', 0 => 'Tidak Aktif'],
                        ['class' => 'select2', 'prompt' => 'Pilih status']
                    ) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'afis_id')->textInput() ?>
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