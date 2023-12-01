<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\JurusanMapelSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jurusan-mapel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jurusan_mapel_id') ?>

    <?= $form->field($model, 'jurusan_id') ?>

    <?= $form->field($model, 'mata_pelajaran_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
