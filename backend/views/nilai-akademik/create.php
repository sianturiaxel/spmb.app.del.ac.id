<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademik $model */

$this->title = 'Create Nilai Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-akademik-create">
    <?= $this->render('_form', [
        'model' => $model,
        'pendaftar' => $pendaftar,
    ]) ?>

</div>