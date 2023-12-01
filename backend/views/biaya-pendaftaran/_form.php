<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BiayaPendaftaran $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="biaya-pendaftaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gelombang_pendaftaran_id')->textInput() ?>

    <?= $form->field($model, 'biaya_daftar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>