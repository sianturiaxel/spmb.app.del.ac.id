<?php

use backend\models\StatusPendaftaran;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Status Pendaftarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-pendaftaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Status Pendaftaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'status_pendaftaran_id',
            'desc',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StatusPendaftaran $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'status_pendaftaran_id' => $model->status_pendaftaran_id]);
                 }
            ],
        ],
    ]); ?>


</div>
