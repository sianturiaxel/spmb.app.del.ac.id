<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PaymentDetail $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="payment-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'calon_mahasiswa_id')->textInput() ?>

    <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fee_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
