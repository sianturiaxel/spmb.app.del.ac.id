<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\NilaiPsikotes $model */

$this->title = $model->nilai_psikotes_id;
$this->params['breadcrumbs'][] = ['label' => 'Nilai Psikotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nilai-psikotes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'nilai_psikotes_id' => $model->nilai_psikotes_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nilai_psikotes_id' => $model->nilai_psikotes_id], [
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
            'nilai_psikotes_id',
            'pendaftar_id',
            'kode_tes',
            'kehadiran',
            'tiu',
            'kategori_tiu',
            'stabilit_as_emosi',
            'temp_kerja',
            'ketelitian',
            'konsistensi',
            'daya_tahan',
            'iq',
            'kategori_iq',
            'hasil',
            'peringkat',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'deleted_at',
            'deleted_by',
        ],
    ]) ?>

</div>
