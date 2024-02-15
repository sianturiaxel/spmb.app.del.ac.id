<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MetodePembayaran $model */

$this->title = 'Create Metode Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Metode Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metode-pembayaran-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>