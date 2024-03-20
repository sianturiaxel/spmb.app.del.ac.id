<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\JenjangPendidikan $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Jenjang Pendidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="jenjang-pendidikan-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="jenjang-pendidikan-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'jenjang_pendidikan_id',                   
                            'name',
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