<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\KodeUjian $model */

$this->title = $model->kode_ujian_id;
$this->params['breadcrumbs'][] = ['label' => 'Kode Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kode-ujian-form container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="kode-ujian-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'kode_ujian_id',
                            [
                                'attribute' => 'gelombang_pendaftaran_id',
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
                            'kode_ujian',
                            'username',
                            // Jangan tampilkan password untuk alasan keamanan
                            'status',
                            'created_at:datetime', // Format sebagai tanggal dan waktu
                            'created_by',
                            'updated_at:datetime',
                            'updated_by',
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