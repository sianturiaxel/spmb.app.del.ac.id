<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademik $model */

$this->title = 'Nilai Akademik Ujian Detail';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nilai-akademik-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="nilai-wawancara-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'nilai_akademik_id',
                            [
                                'attribute' => 'Nama Pendaftar',
                                'value' => function ($model) {
                                    return $model->pendaftar ? $model->pendaftar->nama : 'Tidak Ada';
                                },
                            ],
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
                            'created_at:datetime',
                            [
                                'attribute' => 'created_by',
                                'value' => function ($model) {
                                    return $model->creator ? $model->creator->username : '-';
                                },
                            ],
                            'updated_at:datetime',
                            [
                                'attribute' => 'updated_by',
                                'value' => function ($model) {
                                    return $model->updater ? $model->updater->username : '-';
                                },
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <?= Html::a('Kembali', Url::to(['index']), ['class' => 'btn btn-warning']) ?>
                </div>
            </div>

        </div>

    </div>
</div>