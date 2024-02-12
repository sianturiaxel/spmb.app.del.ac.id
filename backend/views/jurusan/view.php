<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\Jurusan $model */

$this->title = 'Jurusan Detail';
$this->params['breadcrumbs'][] = ['label' => 'Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jurusan-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="kode-ujian-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'jurusan',    
                            [
                                'attribute' => 'fakultas_id',
                                'value' => function ($model) {
                                    return $model->fakultas ? $model->fakultas->nama : 'Tidak Ada';
                                },
                            ],
                            'nama',
                            'prefix_nim',
                            'counter_nim',
                            [
                                'attribute' => 'status_active',
                                'value' => function ($model) {
                                    return $model->status_active == 1 ? 'Aktif' : 'Tidak Aktif';
                                },
                            ],
                            'url:url',
                            [
                                'attribute' => 'desc',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return strip_tags($model->desc);
                                },
                            ],
                            'afis_id',

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