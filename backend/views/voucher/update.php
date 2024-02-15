<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Voucher $model */

$this->title = 'Update Voucher';
$this->params['breadcrumbs'][] = ['label' => 'Voucher', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="voucher-update">
    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
    ]) ?>

</div>