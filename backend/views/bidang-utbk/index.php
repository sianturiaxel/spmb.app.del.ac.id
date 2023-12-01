<?php

use backend\models\BidangUtbk;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\BidangUtbkSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bidang Utbks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-utbk-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bidang Utbk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bidang_utbk_id',
            'kategori_bidang_utbk_id',
            'name',
            'deleted',
            'deleted_at',
            //'deleted_by',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BidangUtbk $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'bidang_utbk_id' => $model->bidang_utbk_id]);
                 }
            ],
        ],
    ]); ?>


</div>
