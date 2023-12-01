<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BidangUtbk $model */

$this->title = 'Update Bidang Utbk: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Utbks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'bidang_utbk_id' => $model->bidang_utbk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidang-utbk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
