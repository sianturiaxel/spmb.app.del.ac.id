<?php

use backend\models\WaktuPengumuman;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\WaktuPengumumanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Waktu Pengumuman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="waktu-pengumuman-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Waktu Pengumuman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'waktu_pengumuman_id',
            'gelombang_pendaftaran_id',
            'jenis_test_id',
            'tanggal_mulai',
            'tanggal_akhir',
            //'catatan',
            //'created_by',
            //'created_date',
            //'updated_by',
            //'updated_date',
            //'deleted_by',
            //'deleted_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, WaktuPengumuman $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'waktu_pengumuman_id' => $model->waktu_pengumuman_id]);
                }
            ],
        ],
    ]); ?>


</div>