<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\JenisUjian $model */

$this->title = 'Jenis Ujian Detail';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Ujian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="jenis-ujian-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="jenjang-pendidikan-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'jenis_ujian_id',                   
                            'name',
                            'desc',
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