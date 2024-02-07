<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancara $model */
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


<div class="nilai-wawancara-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label" for="pendaftar-select">Nama Pendaftaran</label>
                    <select class="form-control select2" id="pendaftar-select" name="NilaiWawancara[pendaftar_id]">
                        <option value="">Pilih Pendaftar</option>
                        <?php foreach ($pendaftar as $p) : ?>
                            <option value="<?= Html::encode($p['pendaftar_id']); ?>" <?= $model->pendaftar_id == $p['pendaftar_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($p['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'nilai_motivasi')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'nilai_gambaran_karir')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'nilai_rekomendasi')->textInput(['maxlength' => true]) ?>
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