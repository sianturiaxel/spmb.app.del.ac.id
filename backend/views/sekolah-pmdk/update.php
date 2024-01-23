<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SekolahPmdk $model */

$this->title = 'Update Sekolah Pmdk: ' . $model->sekolah_pmdk_id;
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Pmdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sekolah_pmdk_id, 'url' => ['view', 'sekolah_pmdk_id' => $model->sekolah_pmdk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sekolah-pmdk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sekolah' => $sekolah,
    ]) ?>

</div>