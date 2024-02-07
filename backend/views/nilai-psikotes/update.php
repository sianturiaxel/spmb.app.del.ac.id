<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiPsikotes $model */

$this->title = 'Update Nilai Psikotes';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Psikotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nilai-psikotes-update">
    <?= $this->render('_form', [
        'model' => $model,
        'pendaftar' => $pendaftar,
    ]) ?>

</div>