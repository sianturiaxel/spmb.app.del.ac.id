<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\LokasiUjian $model */

$this->title = $model->lokasi_ujian_id;
$this->params['breadcrumbs'][] = ['label' => 'Lokasi Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lokasi-ujian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'lokasi_ujian_id' => $model->lokasi_ujian_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'lokasi_ujian_id' => $model->lokasi_ujian_id], [
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
            'lokasi_ujian_id',
            'gelombang_pendaftaran_id',
            'jenis_test_id',
            'kode_lokasi',
            'gedung',
            'alamat',
            'tanggal_mulai',
            'tanggal_selesai',
            'desc',
            'is_active',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'deleted_at',
            'deleted_by',
        ],
    ]) ?>

</div>
