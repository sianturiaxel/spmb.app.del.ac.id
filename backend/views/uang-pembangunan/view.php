<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\UangPembangunan $model */

$this->title = $model->uang_pembangunan_id;
$this->params['breadcrumbs'][] = ['label' => 'Uang Pembangunans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="uang-pembangunan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'uang_pembangunan_id' => $model->uang_pembangunan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'uang_pembangunan_id' => $model->uang_pembangunan_id], [
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
            'uang_pembangunan_id',
            'gelombang_pendaftaran_id',
            'jurusan_id',
            'minimum_n',
            'base_n',
            'multi_n',
        ],
    ]) ?>

</div>
