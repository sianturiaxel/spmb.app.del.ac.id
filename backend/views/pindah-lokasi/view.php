<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\PindahLokasi $model */

$this->title = $model->pindah_lokasi_id;
$this->params['breadcrumbs'][] = ['label' => 'Pindah Lokasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pindah-lokasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'pindah_lokasi_id' => $model->pindah_lokasi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'pindah_lokasi_id' => $model->pindah_lokasi_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pindah_lokasi_id',
            'pendaftar_id',
            'lokasi_saat_ini',
            'lokasi_tujuan',
            'file_pendukung',
            'status',
            'catatan',
            'created_by',
            'created_date',
            'updated_by',
            'updated_date',
            'deleted_by',
            'deleted_date',
        ],
    ]) ?>

</div>
