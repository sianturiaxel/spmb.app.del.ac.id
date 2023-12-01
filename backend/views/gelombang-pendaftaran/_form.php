<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\GelombangPendaftaran $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="gelombang-pendaftaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mulai')->textInput() ?>

    <?= $form->field($model, 'berakhir')->textInput() ?>

    <?= $form->field($model, 'prefix_kode_pendaftaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'counter')->textInput() ?>

    <?= $form->field($model, 'is_online')->textInput() ?>

    <?= $form->field($model, 'is_bayar')->textInput() ?>

    <?= $form->field($model, 'jenis_ujian_id')->textInput() ?>

    <?= $form->field($model, 'minimum_n')->textInput() ?>

    <?= $form->field($model, 'base_n')->textInput() ?>

    <?= $form->field($model, 'multi_n')->textInput() ?>

    <?= $form->field($model, 'tanggal_ujian')->textInput() ?>

    <?= $form->field($model, 'jam_mulai')->textInput() ?>

    <?= $form->field($model, 'jam_selesai')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
