<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\SekolahPmdk $model */

$this->title = $model->sekolah_pmdk_id;
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Pmdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="kode-ujian-form container mt-5">
    <div class="card">
        <div class="row">
            <div class="card-body">
                <div class="sekolah-pmdk-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'sekolah_pmdk_id',
                            [
                                'attribute' => 'Nama Sekolah',
                                'value' => function ($model) {
                                    return $model->sekolah ? $model->sekolah->nama : 'Tidak Ada';
                                },
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <?= Html::a('Kembali', Url::to(['index']), ['class' => 'btn btn-warning']) ?>
            </div>
        </div>
    </div>

</div>