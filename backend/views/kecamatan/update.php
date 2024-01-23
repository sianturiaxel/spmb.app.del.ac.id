<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Kecamatan $model */

$this->title = 'Update Kecamatan: ' . $model->kecamatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Kecamatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kecamatan_id, 'url' => ['view', 'kecamatan_id' => $model->kecamatan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kecamatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
