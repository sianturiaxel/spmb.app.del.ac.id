<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Jurusan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jurusan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fakultas_id')->textInput() ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prefix_nim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'counter_nim')->textInput() ?>

    <?= $form->field($model, 'status_active')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'afis_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
