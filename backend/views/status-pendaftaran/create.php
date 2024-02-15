<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StatusPendaftaran $model */

$this->title = 'Create Status Pendaftaran';
$this->params['breadcrumbs'][] = ['label' => 'Status Pendaftaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-pendaftaran-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>