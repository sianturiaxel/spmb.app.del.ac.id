<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NilaiPsikotes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="nilai-psikotes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pendaftar_id')->textInput() ?>

    <?= $form->field($model, 'kode_tes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kehadiran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tiu')->textInput() ?>

    <?= $form->field($model, 'kategori_tiu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stabilit_as_emosi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temp_kerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ketelitian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'konsistensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'daya_tahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iq')->textInput() ?>

    <?= $form->field($model, 'kategori_iq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hasil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peringkat')->textInput() ?>

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
