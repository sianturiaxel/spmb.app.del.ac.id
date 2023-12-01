<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademikSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="nilai-akademik-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nilai_akademik_id') ?>

    <?= $form->field($model, 'pendaftar_id') ?>

    <?= $form->field($model, 'mat_benar') ?>

    <?= $form->field($model, 'mat_salah') ?>

    <?= $form->field($model, 'ing_benar') ?>

    <?php // echo $form->field($model, 'ing_salah') ?>

    <?php // echo $form->field($model, 'tpa_benar') ?>

    <?php // echo $form->field($model, 'tpa_salah') ?>

    <?php // echo $form->field($model, 'total_kosong') ?>

    <?php // echo $form->field($model, 'mp_tinggi') ?>

    <?php // echo $form->field($model, 'mp_rendah') ?>

    <?php // echo $form->field($model, 'perbandingan_mat_ing') ?>

    <?php // echo $form->field($model, 'jumlah_soal') ?>

    <?php // echo $form->field($model, 'hasil_score') ?>

    <?php // echo $form->field($model, 'scala_score') ?>

    <?php // echo $form->field($model, 'usulan_panitia') ?>

    <?php // echo $form->field($model, 'pilihan1') ?>

    <?php // echo $form->field($model, 'pilihan2') ?>

    <?php // echo $form->field($model, 'pilihan3') ?>

    <?php // echo $form->field($model, 'hasil_akhir_pilihan') ?>

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
