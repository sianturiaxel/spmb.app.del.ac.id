<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PaymentDetailSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="payment-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'payment_detail_id') ?>

    <?= $form->field($model, 'calon_mahasiswa_id') ?>

    <?= $form->field($model, 'total_amount') ?>

    <?= $form->field($model, 'fee_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
