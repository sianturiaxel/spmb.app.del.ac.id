<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PenangguhanDaftarUlang $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="penangguhan-daftar-ulang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'calon_mahasiswa_id')->textInput() ?>

    <?= $form->field($model, 'total_ditangguhkan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_bayar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_penangguhan')->textInput() ?>

    <?= $form->field($model, 'approve_panitia')->textInput() ?>

    <?= $form->field($model, 'approve_keuangan')->textInput() ?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleted_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
