<?php

use backend\models\PindahLokasi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pindah Lokasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pindah-lokasi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pindah Lokasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pindah_lokasi_id',
            'pendaftar_id',
            'lokasi_saat_ini',
            'lokasi_tujuan',
            'file_pendukung',
            //'status',
            //'catatan',
            //'created_by',
            //'created_date',
            //'updated_by',
            //'updated_date',
            //'deleted_by',
            //'deleted_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PindahLokasi $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'pindah_lokasi_id' => $model->pindah_lokasi_id]);
                 }
            ],
        ],
    ]); ?>


</div>
