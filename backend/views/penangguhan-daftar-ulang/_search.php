<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PenangguhanDaftarUlangSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="penangguhan-daftar-ulang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'penangguhan_daftar_ulang_id') ?>

    <?= $form->field($model, 'calon_mahasiswa_id') ?>

    <?= $form->field($model, 'total_ditangguhkan') ?>

    <?= $form->field($model, 'total_bayar') ?>

    <?= $form->field($model, 'tanggal_penangguhan') ?>

    <?php // echo $form->field($model, 'approve_panitia') ?>

    <?php // echo $form->field($model, 'approve_keuangan') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'deleted_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
