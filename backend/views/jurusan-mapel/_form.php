<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\JurusanMapel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jurusan-mapel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jurusan_id')->textInput() ?>

    <?= $form->field($model, 'mata_pelajaran_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
