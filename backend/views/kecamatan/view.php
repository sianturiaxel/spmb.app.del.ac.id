<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\Kecamatan $model */

$this->title = $model->kecamatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Kecamatans', 'url' => ['index']];
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
                            //'kecamatan_id',
                            [
                                'attribute' => 'Kode Kabupaten',
                                'value' => function ($model) {
                                    return $model->kabupaten_id ? $model->kabupaten->nama : 'Tidak Ada';
                                },
                            ],
                            'kecamatan_id',
                            'nama',

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