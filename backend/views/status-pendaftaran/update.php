<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StatusPendaftaran $model */

$this->title = 'Update Status Pendaftaran';
$this->params['breadcrumbs'][] = ['label' => 'Status Pendaftaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-pendaftaran-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>