<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Voucher $model */

$this->title = 'Create Voucher';
$this->params['breadcrumbs'][] = ['label' => 'Voucher', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-create">
    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
    ]) ?>

</div>