<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MetodePembayaran $model */

$this->title = 'Update Metode Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Metode Pembayaran', 'url' => ['index']];
?>
<div class="metode-pembayaran-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>