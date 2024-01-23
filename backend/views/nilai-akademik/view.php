<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademik $model */

$this->title = $model->nilai_akademik_id;
$this->params['breadcrumbs'][] = ['label' => 'Nilai Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nilai-akademik-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'nilai_akademik_id' => $model->nilai_akademik_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nilai_akademik_id' => $model->nilai_akademik_id], [
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
            'nilai_akademik_id',
            'pendaftar_id',
            'mat_benar',
            'mat_salah',
            'ing_benar',
            'ing_salah',
            'tpa_benar',
            'tpa_salah',
            'total_kosong',
            'mp_tinggi',
            'mp_rendah',
            'perbandingan_mat_ing',
            'jumlah_soal',
            'hasil_score',
            'scala_score',
            'usulan_panitia',
            'pilihan1',
            'pilihan2',
            'pilihan3',
            'hasil_akhir_pilihan',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'deleted_at',
            'deleted_by',
        ],
    ]) ?>

</div>
