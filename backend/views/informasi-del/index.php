<?php

use backend\models\InformasiDel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Informasi Dels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasi-del-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Informasi Del', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'informasi_del_id',
            'desc',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, InformasiDel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'informasi_del_id' => $model->informasi_del_id]);
                 }
            ],
        ],
    ]); ?>


</div>
