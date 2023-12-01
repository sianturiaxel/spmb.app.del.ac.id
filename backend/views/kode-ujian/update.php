<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\KodeUjian $model */

$this->title = 'Update Kode Ujian: ' . $model->kode_ujian_id;
$this->params['breadcrumbs'][] = ['label' => 'Kode Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_ujian_id, 'url' => ['view', 'kode_ujian_id' => $model->kode_ujian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kode-ujian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
