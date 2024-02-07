<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancara $model */

$this->title = 'Update Nilai Wawancara';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Wawancaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nilai-wawancara-update">
    <?= $this->render('_form', [
        'model' => $model,
        'pendaftar' => $pendaftar,
    ]) ?>

</div>