<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\StatusPendaftaran $model */

$this->title = 'Status Pendaftaran Detail';
$this->params['breadcrumbs'][] = ['label' => 'Status Pendaftaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="status-pendaftaran-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="status-pendaftaran-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'status_pendaftaran_id',                   
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