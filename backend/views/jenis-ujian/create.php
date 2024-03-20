<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JenisUjian $model */

$this->title = 'Create Jenis Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Ujian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-ujian-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>