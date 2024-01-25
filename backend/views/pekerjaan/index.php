<?php

use backend\models\Pekerjaan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pekerjaans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerjaan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pekerjaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pekerjaan_id',
            'nama',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pekerjaan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'pekerjaan_id' => $model->pekerjaan_id]);
                 }
            ],
        ],
    ]); ?>


</div>
