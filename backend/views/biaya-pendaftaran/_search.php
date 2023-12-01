<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BiayaPendaftaranSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="biaya-pendaftaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'biaya_pendaftaran_id') ?>

    <?= $form->field($model, 'gelombang_pendaftaran_id') ?>

    <?= $form->field($model, 'biaya_daftar') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
