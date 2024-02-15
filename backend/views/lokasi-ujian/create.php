<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\LokasiUjian $model */

$this->title = 'Create Lokasi Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Lokasi Ujian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-ujian-create">
    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
        'jenisTest' => $jenisTest,
    ]) ?>

</div>