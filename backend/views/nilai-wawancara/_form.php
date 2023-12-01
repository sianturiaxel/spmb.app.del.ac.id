<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancara $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="nilai-wawancara-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pendaftar_id')->textInput() ?>

    <?= $form->field($model, 'nilai_motivasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai_gambaran_karir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai_rekomendasi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
