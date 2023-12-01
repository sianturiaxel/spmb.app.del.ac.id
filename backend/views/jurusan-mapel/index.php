<?php

use backend\models\JurusanMapel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\JurusanMapelSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Jurusan Mapels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurusan-mapel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Jurusan Mapel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'jurusan_mapel_id',
            'jurusan_id',
            'mata_pelajaran_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JurusanMapel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'jurusan_mapel_id' => $model->jurusan_mapel_id]);
                 }
            ],
        ],
    ]); ?>


</div>
