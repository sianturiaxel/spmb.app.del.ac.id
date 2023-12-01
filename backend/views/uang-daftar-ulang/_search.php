<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UangDaftarUlangSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="uang-daftar-ulang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uang_daftar_ulang_id') ?>

    <?= $form->field($model, 'gelombang_pendaftaran_id') ?>

    <?= $form->field($model, 'perlengkapan_mhs') ?>

    <?= $form->field($model, 'perlengkapan_makan') ?>

    <?= $form->field($model, 'spp_tahap_1') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
