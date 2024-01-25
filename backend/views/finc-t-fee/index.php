<?php

use backend\models\FincTFee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Finc T Fees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finc-tfee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Finc T Fee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fee_id',
            'name',
            'fee_reference_id',
            'payment_type_key',
            'is_fix',
            //'is_active',
            //'amount',
            //'is_spmb',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //'deleted',
            //'deleted_at',
            //'deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FincTFee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'fee_id' => $model->fee_id]);
                 }
            ],
        ],
    ]); ?>


</div>
