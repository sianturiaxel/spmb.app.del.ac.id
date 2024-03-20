<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PindahLokasi $model */

$this->title = 'Update Pindah Lokasi: ' . $model->pindah_lokasi_id;
$this->params['breadcrumbs'][] = ['label' => 'Pindah Lokasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pindah_lokasi_id, 'url' => ['view', 'pindah_lokasi_id' => $model->pindah_lokasi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pindah-lokasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
