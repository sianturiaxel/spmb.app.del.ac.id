<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\KodeUjian $model */

$this->title = 'Kode Ujian Detail';
$this->params['breadcrumbs'][] = ['label' => 'Kode Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kode-ujian-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="kode-ujian-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'kode_ujian_id',
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
                            'kode_ujian',
                            'username',

                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return $model->status == 1 ? 'Aktif' : 'Tidak Aktif';
                                },
                                'format' => 'text',
                            ],
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