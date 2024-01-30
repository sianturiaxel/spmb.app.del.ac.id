<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\WaktuPengumuman $model */

$this->params['breadcrumbs'][] = ['label' => 'Waktu Pengumumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="waktu-pengumuman-view container mt-5 mb-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'waktu_pengumuman_id',
                        [
                            'attribute' => 'gelombang_pendaftaran',
                            'value' => function ($model) {
                                return $model->gelombangPendaftaran ? $model->gelombangPendaftaran->desc : 'Tidak Ada';
                            },
                        ],
                        [
                            'attribute' => 'jenis_test_id',
                            'value' => function ($model) {
                                return $model->jenisTest ? $model->jenisTest->nama : 'Tidak Ada';
                            },
                        ],

                        'tanggal_mulai:date',
                        'tanggal_akhir:date',
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
            <div class="card-footer">
                <div class="form-group">
                    <?= Html::a('Kembali', Url::to(['index']), ['class' => 'btn btn-warning']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br>