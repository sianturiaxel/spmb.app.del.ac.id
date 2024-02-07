<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademik $model */
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

<div class="nilai-akademik-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label" for="pendaftar-select">Nama Pendaftaran</label>
                    <select class="form-control select2" id="pendaftar-select" name="NilaiAkademik[pendaftar_id]">
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
                <div class="col-md-2">
                    <?= $form->field($model, 'mat_benar')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'mat_salah')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'ing_benar')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'ing_salah')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'tpa_benar')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'tpa_salah')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'total_kosong')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'mp_tinggi')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'mp_rendah')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'perbandingan_mat_ing')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'jumlah_soal')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'hasil_score')->textInput() ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'scala_score')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'usulan_panitia')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'pilihan1')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'pilihan2')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'pilihan3')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'usulan_panitia')->textInput(['maxlength' => true]) ?>
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