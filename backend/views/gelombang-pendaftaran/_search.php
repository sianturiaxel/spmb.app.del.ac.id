<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\GelombangPendaftaranSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="gelombang-pendaftaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gelombang_pendaftaran_id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'mulai') ?>

    <?= $form->field($model, 'berakhir') ?>

    <?php // echo $form->field($model, 'prefix_kode_pendaftaran') ?>

    <?php // echo $form->field($model, 'counter') ?>

    <?php // echo $form->field($model, 'is_online') ?>

    <?php // echo $form->field($model, 'is_bayar') ?>

    <?php // echo $form->field($model, 'jenis_ujian_id') ?>

    <?php // echo $form->field($model, 'minimum_n') ?>

    <?php // echo $form->field($model, 'base_n') ?>

    <?php // echo $form->field($model, 'multi_n') ?>

    <?php // echo $form->field($model, 'tanggal_ujian') ?>

    <?php // echo $form->field($model, 'jam_mulai') ?>

    <?php // echo $form->field($model, 'jam_selesai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
