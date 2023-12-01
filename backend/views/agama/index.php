<?php

use backend\models\Agama;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\AgamaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Agamas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agama-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Agama', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'agama_id',
            'desc',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Agama $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'agama_id' => $model->agama_id]);
                 }
            ],
        ],
    ]); ?>


</div>
