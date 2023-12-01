<?php

use backend\models\UangPembangunan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UangPembangunanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Uang Pembangunans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uang-pembangunan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Uang Pembangunan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uang_pembangunan_id',
            'gelombang_pendaftaran_id',
            'jurusan_id',
            'minimum_n',
            'base_n',
            //'multi_n',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UangPembangunan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'uang_pembangunan_id' => $model->uang_pembangunan_id]);
                 }
            ],
        ],
    ]); ?>


</div>
