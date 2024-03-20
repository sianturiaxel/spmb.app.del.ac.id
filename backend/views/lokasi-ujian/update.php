<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\LokasiUjian $model */

$this->title = 'Update Lokasi Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Lokasi Ujian', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lokasi-ujian-update">
    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
        'jenisTest' => $jenisTest,
    ]) ?>

</div>