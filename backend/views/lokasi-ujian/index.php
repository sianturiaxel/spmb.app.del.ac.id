<?php

use backend\models\LokasiUjian;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\LokasiUjianSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Lokasi Ujians';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-ujian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Lokasi Ujian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'lokasi_ujian_id',
            'gelombang_pendaftaran_id',
            'jenis_test_id',
            'kode_lokasi',
            'gedung',
            //'alamat',
            //'tanggal_mulai',
            //'tanggal_selesai',
            //'desc',
            //'is_active',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'deleted_at',
            //'deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, LokasiUjian $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'lokasi_ujian_id' => $model->lokasi_ujian_id]);
                 }
            ],
        ],
    ]); ?>


</div>
