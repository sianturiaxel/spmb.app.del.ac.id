<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BidangUtbk $model */

$this->title = 'Create Bidang Utbk';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Utbks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-utbk-create">

    <?= $this->render('_form', [
        'model' => $model,
        'kategoriBidangUtbk' => $kategoriBidangUtbk,
    ]) ?>

</div>