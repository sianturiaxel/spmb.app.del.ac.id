<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NilaiPsikotesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="nilai-psikotes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nilai_psikotes_id') ?>

    <?= $form->field($model, 'pendaftar_id') ?>

    <?= $form->field($model, 'kode_tes') ?>

    <?= $form->field($model, 'kehadiran') ?>

    <?= $form->field($model, 'tiu') ?>

    <?php // echo $form->field($model, 'kategori_tiu') ?>

    <?php // echo $form->field($model, 'stabilit_as_emosi') ?>

    <?php // echo $form->field($model, 'temp_kerja') ?>

    <?php // echo $form->field($model, 'ketelitian') ?>

    <?php // echo $form->field($model, 'konsistensi') ?>

    <?php // echo $form->field($model, 'daya_tahan') ?>

    <?php // echo $form->field($model, 'iq') ?>

    <?php // echo $form->field($model, 'kategori_iq') ?>

    <?php // echo $form->field($model, 'hasil') ?>

    <?php // echo $form->field($model, 'peringkat') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
