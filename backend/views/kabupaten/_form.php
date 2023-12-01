<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Kabupaten $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="kabupaten-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kabupaten_id')->textInput() ?>

    <?= $form->field($model, 'provinsi_id')->textInput() ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
