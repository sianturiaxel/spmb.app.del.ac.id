<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\SekolahPmdk $model */

$this->title = $model->sekolah_pmdk_id;
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Pmdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sekolah-pmdk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'sekolah_pmdk_id' => $model->sekolah_pmdk_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'sekolah_pmdk_id' => $model->sekolah_pmdk_id], [
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
            'sekolah_pmdk_id',
            'sekolah_id',
        ],
    ]) ?>

</div>
