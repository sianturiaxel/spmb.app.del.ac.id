<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\JurusanSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jurusan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jurusan_id') ?>

    <?= $form->field($model, 'fakultas_id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'prefix_nim') ?>

    <?= $form->field($model, 'counter_nim') ?>

    <?php // echo $form->field($model, 'status_active') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'afis_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
