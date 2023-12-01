<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\BerkasDaftarUlang $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Berkas Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="berkas-daftar-ulang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'berkas_daftar_ulang_id' => $model->berkas_daftar_ulang_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'berkas_daftar_ulang_id' => $model->berkas_daftar_ulang_id], [
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
            'berkas_daftar_ulang_id',
            'name',
            'desc:ntext',
            'berkas',
            'link',
            'is_active',
            'deleted',
        ],
    ]) ?>

</div>
