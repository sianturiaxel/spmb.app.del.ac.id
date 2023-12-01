<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\UangDaftarUlang $model */

$this->title = $model->uang_daftar_ulang_id;
$this->params['breadcrumbs'][] = ['label' => 'Uang Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="uang-daftar-ulang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'uang_daftar_ulang_id' => $model->uang_daftar_ulang_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'uang_daftar_ulang_id' => $model->uang_daftar_ulang_id], [
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
            'uang_daftar_ulang_id',
            'gelombang_pendaftaran_id',
            'perlengkapan_mhs',
            'perlengkapan_makan',
            'spp_tahap_1',
        ],
    ]) ?>

</div>
