<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PaymentDetail $model */

$this->title = 'Create Payment Detail';
$this->params['breadcrumbs'][] = ['label' => 'Payment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
