<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Kecamatan $model */
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


<div class="provinsi-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" for="kabupaten-select">Kabupaten</label>
                    <select class="form-control select2" id="kabupaten-select" name="Kecamatan[kabupaten_id]">
                        <option value="">Pilih Kabupaten</option>
                        <?php foreach ($kabupaten as $k) : ?>
                            <option value="<?= Html::encode($k['kabupaten_id']); ?>" <?= $model->kabupaten_id == $k['kabupaten_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($k['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'kecamatan_id')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
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
</div>


<style>
    .select2-container--default .select2-selection--single {
        height: auto;
        /* Atau nilai lain yang sesuai dengan form lain */
    }
</style>