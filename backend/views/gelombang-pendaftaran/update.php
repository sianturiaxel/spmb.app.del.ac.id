<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GelombangPendaftaran $model */

$this->title = 'Update Gelombang Pendaftaran: ' . $model->gelombang_pendaftaran_id;
$this->params['breadcrumbs'][] = ['label' => 'Gelombang Pendaftarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gelombang_pendaftaran_id, 'url' => ['view', 'gelombang_pendaftaran_id' => $model->gelombang_pendaftaran_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gelombang-pendaftaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
