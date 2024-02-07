<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademik $model */

$this->title = 'Update Nilai Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nilai-akademik-update">
    <?= $this->render('_form', [
        'model' => $model,
        'pendaftar' => $pendaftar,
    ]) ?>

</div>