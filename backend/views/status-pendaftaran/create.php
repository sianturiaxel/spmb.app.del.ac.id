<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StatusPendaftaran $model */

$this->title = 'Create Status Pendaftaran';
$this->params['breadcrumbs'][] = ['label' => 'Status Pendaftarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-pendaftaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
