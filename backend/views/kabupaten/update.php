<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Kabupaten $model */

$this->title = 'Update Kabupaten: ' . $model->kabupaten_id;
$this->params['breadcrumbs'][] = ['label' => 'Kabupatens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kabupaten_id, 'url' => ['view', 'kabupaten_id' => $model->kabupaten_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kabupaten-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
