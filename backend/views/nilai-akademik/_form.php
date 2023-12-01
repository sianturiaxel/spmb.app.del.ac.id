<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademik $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="nilai-akademik-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pendaftar_id')->textInput() ?>

    <?= $form->field($model, 'mat_benar')->textInput() ?>

    <?= $form->field($model, 'mat_salah')->textInput() ?>

    <?= $form->field($model, 'ing_benar')->textInput() ?>

    <?= $form->field($model, 'ing_salah')->textInput() ?>

    <?= $form->field($model, 'tpa_benar')->textInput() ?>

    <?= $form->field($model, 'tpa_salah')->textInput() ?>

    <?= $form->field($model, 'total_kosong')->textInput() ?>

    <?= $form->field($model, 'mp_tinggi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mp_rendah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'perbandingan_mat_ing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah_soal')->textInput() ?>

    <?= $form->field($model, 'hasil_score')->textInput() ?>

    <?= $form->field($model, 'scala_score')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usulan_panitia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pilihan1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pilihan2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pilihan3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hasil_akhir_pilihan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
