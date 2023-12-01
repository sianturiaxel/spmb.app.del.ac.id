<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Jurusan $model */

$this->title = $model->jurusan_id;
$this->params['breadcrumbs'][] = ['label' => 'Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jurusan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'jurusan_id' => $model->jurusan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'jurusan_id' => $model->jurusan_id], [
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
            'jurusan_id',
            'fakultas_id',
            'nama',
            'prefix_nim',
            'counter_nim',
            'status_active',
            'url:url',
            'desc:ntext',
            'afis_id',
        ],
    ]) ?>

</div>
