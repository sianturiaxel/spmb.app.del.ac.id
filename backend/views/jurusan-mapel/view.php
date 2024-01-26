<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\JurusanMapel $model */

$this->title = $model->jurusan_mapel_id;

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jurusan-mapel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'jurusan_mapel_id' => $model->jurusan_mapel_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'jurusan_mapel_id' => $model->jurusan_mapel_id], [
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
            'jurusan_mapel_id',
            'jurusan_id',
            'mata_pelajaran_id',
        ],
    ]) ?>

</div>