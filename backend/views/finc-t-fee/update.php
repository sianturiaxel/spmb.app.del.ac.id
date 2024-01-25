<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FincTFee $model */

$this->title = 'Update Finc T Fee: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Finc T Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'fee_id' => $model->fee_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="finc-tfee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
