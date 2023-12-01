<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\PenangguhanDaftarUlang $model */

$this->title = $model->penangguhan_daftar_ulang_id;
$this->params['breadcrumbs'][] = ['label' => 'Penangguhan Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="penangguhan-daftar-ulang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'penangguhan_daftar_ulang_id' => $model->penangguhan_daftar_ulang_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'penangguhan_daftar_ulang_id' => $model->penangguhan_daftar_ulang_id], [
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
            'penangguhan_daftar_ulang_id',
            'calon_mahasiswa_id',
            'total_ditangguhkan',
            'total_bayar',
            'tanggal_penangguhan',
            'approve_panitia',
            'approve_keuangan',
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
