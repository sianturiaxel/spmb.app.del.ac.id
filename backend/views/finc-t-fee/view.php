<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\FincTFee $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Finc T Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="finc-tfee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'fee_id' => $model->fee_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'fee_id' => $model->fee_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fee_id',
            'name',
            'fee_reference_id',
            'payment_type_key',
            'is_fix',
            'is_active',
            'amount',
            'is_spmb',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted',
            'deleted_at',
            'deleted_by',
        ],
    ]) ?>

</div>
