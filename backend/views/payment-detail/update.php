<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PaymentDetail $model */

$this->title = 'Update Payment Detail';
$this->params['breadcrumbs'][] = ['label' => 'Payment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payment-detail-update">
    <?= $this->render('_form', [
        'model' => $model,
        'calonMahasiswa' => $calonMahasiswa,
    ]) ?>

</div>