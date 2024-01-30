<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\components\RupiahFormatter;
use yii;

/** @var yii\web\View $this */
/** @var backend\models\UangDaftarUlang $model */

$this->title = 'Uang Daftar Ulang Detail';
$this->params['breadcrumbs'][] = ['label' => 'Uang Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="uang-daftar-ulang-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="kode-ujian-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'uang_daftar_ulang_id',
                            [
                                'attribute' => 'gelombang_pendaftaran',
                                'value' => function ($model) {
                                    return $model->gelombangPendaftaran ? $model->gelombangPendaftaran->desc : 'Tidak Ada';
                                },
                            ],

                            [
                                'attribute' => 'perlengkapan_mhs',
                                'value' => function ($model) {
                                    return RupiahFormatter::format($model->perlengkapan_mhs);
                                },
                            ],
                            [
                                'attribute' => 'perlengkapan_makan',
                                'value' => function ($model) {
                                    return RupiahFormatter::format($model->perlengkapan_makan);
                                },
                            ],
                            [
                                'attribute' => 'spp_tahap_1',
                                'value' => function ($model) {
                                    return RupiahFormatter::format($model->spp_tahap_1);
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