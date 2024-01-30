<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UangPembangunan $model */

$this->title = 'Update Uang Pembangunan';
$this->params['breadcrumbs'][] = ['label' => 'Uang Pembangunans', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uang-pembangunan-update">
    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
        'jurusan' => $jurusan,
    ]) ?>

</div>