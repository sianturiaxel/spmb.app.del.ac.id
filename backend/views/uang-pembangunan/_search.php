<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UangPembangunanSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="uang-pembangunan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uang_pembangunan_id') ?>

    <?= $form->field($model, 'gelombang_pendaftaran_id') ?>

    <?= $form->field($model, 'jurusan_id') ?>

    <?= $form->field($model, 'minimum_n') ?>

    <?= $form->field($model, 'base_n') ?>

    <?php // echo $form->field($model, 'multi_n') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
