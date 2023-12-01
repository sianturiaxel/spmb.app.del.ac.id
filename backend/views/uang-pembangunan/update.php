<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UangPembangunan $model */

$this->title = 'Update Uang Pembangunan: ' . $model->uang_pembangunan_id;
$this->params['breadcrumbs'][] = ['label' => 'Uang Pembangunans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uang_pembangunan_id, 'url' => ['view', 'uang_pembangunan_id' => $model->uang_pembangunan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uang-pembangunan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
