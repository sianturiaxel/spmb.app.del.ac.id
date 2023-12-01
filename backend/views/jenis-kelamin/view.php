<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\JenisKelamin $model */

$this->title = $model->jenis_kelamin_id;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Kelamins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jenis-kelamin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'jenis_kelamin_id' => $model->jenis_kelamin_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'jenis_kelamin_id' => $model->jenis_kelamin_id], [
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
            'jenis_kelamin_id',
            'desc',
        ],
    ]) ?>

</div>
