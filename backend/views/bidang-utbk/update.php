<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BidangUtbk $model */

$this->title = 'Update Bidang Utbk';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Utbks', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidang-utbk-update">
    <?= $this->render('_form', [
        'model' => $model,
        'kategoriBidangUtbk' => $kategoriBidangUtbk,
    ]) ?>

</div>