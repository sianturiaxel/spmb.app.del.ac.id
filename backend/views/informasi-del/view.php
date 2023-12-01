<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\InformasiDel $model */

$this->title = $model->informasi_del_id;
$this->params['breadcrumbs'][] = ['label' => 'Informasi Dels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="informasi-del-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'informasi_del_id' => $model->informasi_del_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'informasi_del_id' => $model->informasi_del_id], [
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
            'informasi_del_id',
            'desc',
        ],
    ]) ?>

</div>
