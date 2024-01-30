<?php
// var_dump($jenisUjian);
// die();

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\GelombangPendaftaran $model */

$this->title = $model->gelombang_pendaftaran_id;
$this->params['breadcrumbs'][] = ['label' => 'Gelombang Pendaftaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="gelombang-pendaftaran-form container mt-5 mb-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'gelombang_pendaftaran_id',
                        'tahun',
                        'desc',
                        'mulai:date',
                        'berakhir:date',
                        'prefix_kode_pendaftaran',
                        'counter',
                        [
                            'attribute' => 'is_online',
                            'value' => function ($model) {
                                return $model->is_online == 1 ? 'Online' : 'Onsite';
                            },
                            'format' => 'text',
                        ],
                        [
                            'attribute' => 'is_bayar',
                            'value' => function ($model) {
                                return $model->is_bayar == 1 ? 'Bayar' : 'Tidak';
                            },
                            'format' => 'text',
                        ],
                        [
                            'attribute' => 'jenis_ujian_id',
                            'value' => function ($model) {
                                return $model->jenisUjian ? $model->jenisUjian->name : 'Tidak Ada';
                            },
                        ],
                        'minimum_n',
                        'base_n',
                        'multi_n',
                        'tanggal_ujian:date',
                        'jam_mulai',
                        'jam_selesai',
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