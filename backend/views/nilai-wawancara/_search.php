<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancaraSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="nilai-wawancara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nilai_wawancara_id') ?>

    <?= $form->field($model, 'pendaftar_id') ?>

    <?= $form->field($model, 'nilai_motivasi') ?>

    <?= $form->field($model, 'nilai_gambaran_karir') ?>

    <?= $form->field($model, 'nilai_rekomendasi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
