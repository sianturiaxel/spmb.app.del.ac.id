<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\GelombangPendaftaran $model */

$this->title = $model->gelombang_pendaftaran_id;
$this->params['breadcrumbs'][] = ['label' => 'Gelombang Pendaftaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="gelombang-pendaftaran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'gelombang_pendaftaran_id' => $model->gelombang_pendaftaran_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'gelombang_pendaftaran_id' => $model->gelombang_pendaftaran_id], [
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
            'gelombang_pendaftaran_id',
            'tahun',
            'desc',
            'mulai',
            'berakhir',
            'prefix_kode_pendaftaran',
            'counter',
            'is_online',
            'is_bayar',
            'jenis_ujian_id',
            'minimum_n',
            'base_n',
            'multi_n',
            'tanggal_ujian',
            'jam_mulai',
            'jam_selesai',
        ],
    ]) ?>

</div>