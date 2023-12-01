<?php

use backend\models\Jurusan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\JurusanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Jurusans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurusan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Jurusan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'jurusan_id',
            'fakultas_id',
            'nama',
            'prefix_nim',
            'counter_nim',
            //'status_active',
            //'url:url',
            //'desc:ntext',
            //'afis_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Jurusan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'jurusan_id' => $model->jurusan_id]);
                 }
            ],
        ],
    ]); ?>


</div>
