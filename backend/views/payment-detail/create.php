<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PaymentDetail $model */

$this->title = 'Create Payment Detail';
$this->params['breadcrumbs'][] = ['label' => 'Payment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-detail-create">
    <?= $this->render('_form', [
        'model' => $model,
        'calonMahasiswa' => $calonMahasiswa,
    ]) ?>

</div>