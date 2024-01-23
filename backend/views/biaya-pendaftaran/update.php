<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BiayaPendaftaran $model */


$this->params['breadcrumbs'][] = ['label' => 'Biaya Pendaftarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->biaya_pendaftaran_id, 'url' => ['view', 'biaya_pendaftaran_id' => $model->biaya_pendaftaran_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="biaya-pendaftaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
        'feeId' => $feeId,

    ]) ?>

</div>