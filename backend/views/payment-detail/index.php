<?php

use backend\models\PaymentDetail;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PaymentDetailSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Payment Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Payment Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'payment_detail_id',
            'calon_mahasiswa_id',
            'total_amount',
            'fee_name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PaymentDetail $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'payment_detail_id' => $model->payment_detail_id]);
                 }
            ],
        ],
    ]); ?>


</div>
