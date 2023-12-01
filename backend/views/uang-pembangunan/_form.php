<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UangPembangunan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="uang-pembangunan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gelombang_pendaftaran_id')->textInput() ?>

    <?= $form->field($model, 'jurusan_id')->textInput() ?>

    <?= $form->field($model, 'minimum_n')->textInput() ?>

    <?= $form->field($model, 'base_n')->textInput() ?>

    <?= $form->field($model, 'multi_n')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
