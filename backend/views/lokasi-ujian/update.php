<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\LokasiUjian $model */

$this->title = 'Update Lokasi Ujian: ' . $model->lokasi_ujian_id;
$this->params['breadcrumbs'][] = ['label' => 'Lokasi Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lokasi_ujian_id, 'url' => ['view', 'lokasi_ujian_id' => $model->lokasi_ujian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lokasi-ujian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
