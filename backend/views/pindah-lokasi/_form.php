<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PindahLokasi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pindah-lokasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pendaftar_id')->textInput() ?>

    <?= $form->field($model, 'lokasi_saat_ini')->textInput() ?>

    <?= $form->field($model, 'lokasi_tujuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_pendukung')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleted_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
