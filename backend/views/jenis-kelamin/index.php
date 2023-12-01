<?php

use backend\models\JenisKelamin;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Jenis Kelamins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-kelamin-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Jenis Kelamin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'jenis_kelamin_id',
            'desc',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JenisKelamin $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'jenis_kelamin_id' => $model->jenis_kelamin_id]);
                 }
            ],
        ],
    ]); ?>


</div>
