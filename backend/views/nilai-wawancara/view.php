<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancara $model */

$this->title = $model->nilai_wawancara_id;
$this->params['breadcrumbs'][] = ['label' => 'Nilai Wawancaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nilai-wawancara-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'nilai_wawancara_id' => $model->nilai_wawancara_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nilai_wawancara_id' => $model->nilai_wawancara_id], [
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
            'nilai_wawancara_id',
            'pendaftar_id',
            'nilai_motivasi',
            'nilai_gambaran_karir',
            'nilai_rekomendasi',
        ],
    ]) ?>

</div>
