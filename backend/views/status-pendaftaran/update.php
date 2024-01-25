<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StatusPendaftaran $model */

$this->title = 'Update Status Pendaftaran: ' . $model->status_pendaftaran_id;
$this->params['breadcrumbs'][] = ['label' => 'Status Pendaftarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->status_pendaftaran_id, 'url' => ['view', 'status_pendaftaran_id' => $model->status_pendaftaran_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-pendaftaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
