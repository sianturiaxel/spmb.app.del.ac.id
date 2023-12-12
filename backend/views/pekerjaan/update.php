<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Pekerjaan $model */

$this->title = 'Update Pekerjaan: ' . $model->pekerjaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Pekerjaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pekerjaan_id, 'url' => ['view', 'pekerjaan_id' => $model->pekerjaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pekerjaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
