<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\JurusanSekolah $model */

$this->title = 'Jurusan Sekolah Detail';
$this->params['breadcrumbs'][] = ['label' => 'Jurusan Sekolah', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="jurusan-sekolah-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="jurusan-sekolah-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'jurusan_sekolah_id',                   
                            'nama',
                            [
                                'attribute' => 'isactive',
                                'value' => function ($model) {
                                    return $model->isactive == 1 ? 'Aktif' : 'Tidak Aktif';
                                },
                            ],
                            'tingkat',
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