<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\BidangUtbk $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Utbks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="bidang-utbk-view container mt-5 mb-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'bidang_utbk_id',
                        //'kategori_bidang_utbk_id',
                        [
                            'attribute' => 'kategori_bidang_utbk_id',
                            'value' => function ($model) {
                                return $model->kategoriBidangUtbk ? $model->kategoriBidangUtbk->name : 'Tidak Ada';
                            },
                        ],
                        'name',
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