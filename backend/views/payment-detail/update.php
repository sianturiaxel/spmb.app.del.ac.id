<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PaymentDetail $model */

$this->title = 'Update Payment Detail: ' . $model->payment_detail_id;
$this->params['breadcrumbs'][] = ['label' => 'Payment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->payment_detail_id, 'url' => ['view', 'payment_detail_id' => $model->payment_detail_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payment-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
