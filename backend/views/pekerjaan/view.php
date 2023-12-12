<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Pekerjaan $model */

$this->title = $model->pekerjaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Pekerjaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pekerjaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'pekerjaan_id' => $model->pekerjaan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'pekerjaan_id' => $model->pekerjaan_id], [
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
            'pekerjaan_id',
            'nama',
        ],
    ]) ?>

</div>
