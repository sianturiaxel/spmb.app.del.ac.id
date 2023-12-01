<?php

use backend\models\UangDaftarUlang;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UangDaftarUlangSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Uang Daftar Ulangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uang-daftar-ulang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Uang Daftar Ulang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uang_daftar_ulang_id',
            'gelombang_pendaftaran_id',
            'perlengkapan_mhs',
            'perlengkapan_makan',
            'spp_tahap_1',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UangDaftarUlang $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'uang_daftar_ulang_id' => $model->uang_daftar_ulang_id]);
                 }
            ],
        ],
    ]); ?>


</div>
