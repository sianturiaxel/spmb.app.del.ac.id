<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\LokasiUjian $model */

$this->title = 'Lokasi Ujian Detail';
$this->params['breadcrumbs'][] = ['label' => 'Lokasi Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="voucher-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="voucher-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'lokasi_ujian_id',                   
                            [
                                'attribute' => 'gelombang_pendaftaran',
                                'value' => function ($model) {
                                    return $model->gelombangPendaftaran ? $model->gelombangPendaftaran->desc : 'Tidak Ada';
                                },
                            ],
                            [
                                'attribute' => 'jenis_tes',
                                'value' => function ($model) {
                                    return $model->jenisTest ? $model->jenisTest->nama : 'Tidak Ada';
                                },
                            ],
                            'kode_lokasi',
                            'gedung',
                            'alamat',
                            'tanggal_mulai',
                            'tanggal_selesai',
                            'desc',
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