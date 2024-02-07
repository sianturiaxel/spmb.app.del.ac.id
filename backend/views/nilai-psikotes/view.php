<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\NilaiPsikotes $model */

$this->title = $model->nilai_psikotes_id;
$this->params['breadcrumbs'][] = ['label' => 'Nilai Psikotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="nilai-psikotes-view container mt-5">
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