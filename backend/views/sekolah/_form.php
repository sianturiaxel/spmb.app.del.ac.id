<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SekolahPmdk $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sekolah-pmdk-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sekolah_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
