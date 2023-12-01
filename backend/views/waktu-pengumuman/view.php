<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\WaktuPengumuman $model */

$this->title = $model->waktu_pengumuman_id;
$this->params['breadcrumbs'][] = ['label' => 'Waktu Pengumumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="waktu-pengumuman-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'waktu_pengumuman_id' => $model->waktu_pengumuman_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'waktu_pengumuman_id' => $model->waktu_pengumuman_id], [
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
            'waktu_pengumuman_id',
            'gelombang_pendaftaran_id',
            'jenis_test_id',
            'tanggal_mulai',
            'tanggal_akhir',
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
