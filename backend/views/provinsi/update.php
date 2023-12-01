<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Provinsi $model */

$this->title = 'Update Provinsi: ' . $model->provinsi_id;
$this->params['breadcrumbs'][] = ['label' => 'Provinsis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->provinsi_id, 'url' => ['view', 'provinsi_id' => $model->provinsi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="provinsi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
