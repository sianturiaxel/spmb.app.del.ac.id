<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancara $model */

$this->title = 'Nilai Wawancara Ujian Detail';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Wawancaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="nilai-wawancara-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="nilai-wawancara-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'nilai_wawancara_id',
                            [
                                'attribute' => 'Nama Pendaftar',
                                'value' => function ($model) {
                                    return $model->pendaftar ? $model->pendaftar->nama : 'Tidak Ada';
                                },
                            ],
                            'nilai_motivasi',
                            'nilai_gambaran_karir',
                            'nilai_rekomendasi',
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