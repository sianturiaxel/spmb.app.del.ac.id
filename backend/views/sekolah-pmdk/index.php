<?php

use backend\models\SekolahPmdk;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\SekolahPmdkSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sekolah Pmdks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sekolah-pmdk-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sekolah Pmdk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sekolah_pmdk_id',
            'sekolah_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SekolahPmdk $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'sekolah_pmdk_id' => $model->sekolah_pmdk_id]);
                 }
            ],
        ],
    ]); ?>


</div>
