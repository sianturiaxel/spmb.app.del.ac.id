<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UangDaftarUlang $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="uang-daftar-ulang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gelombang_pendaftaran_id')->textInput() ?>

    <?= $form->field($model, 'perlengkapan_mhs')->textInput() ?>

    <?= $form->field($model, 'perlengkapan_makan')->textInput() ?>

    <?= $form->field($model, 'spp_tahap_1')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
