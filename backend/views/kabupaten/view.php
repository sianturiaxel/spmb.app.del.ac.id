<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Kabupaten $model */

$this->title = $model->kabupaten_id;
$this->params['breadcrumbs'][] = ['label' => 'Kabupatens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kabupaten-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'kabupaten_id' => $model->kabupaten_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'kabupaten_id' => $model->kabupaten_id], [
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
            'kabupaten_id',
            'provinsi_id',
            'nama',
        ],
    ]) ?>

</div>
