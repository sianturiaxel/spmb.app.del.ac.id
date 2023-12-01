<?php

use backend\models\PenangguhanDaftarUlang;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PenangguhanDaftarUlangSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Penangguhan Daftar Ulangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penangguhan-daftar-ulang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Penangguhan Daftar Ulang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'penangguhan_daftar_ulang_id',
            'calon_mahasiswa_id',
            'total_ditangguhkan',
            'total_bayar',
            'tanggal_penangguhan',
            //'approve_panitia',
            //'approve_keuangan',
            //'catatan',
            //'created_by',
            //'created_date',
            //'updated_by',
            //'updated_date',
            //'deleted_by',
            //'deleted_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PenangguhanDaftarUlang $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'penangguhan_daftar_ulang_id' => $model->penangguhan_daftar_ulang_id]);
                 }
            ],
        ],
    ]); ?>


</div>
