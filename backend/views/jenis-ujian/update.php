<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JenisUjian $model */

$this->title = 'Update Jenis Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-ujian-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>