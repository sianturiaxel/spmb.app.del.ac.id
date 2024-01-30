<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\WaktuPengumuman $model */

$this->title = 'Update Waktu Pengumuman: ' . $model->waktu_pengumuman_id;
$this->params['breadcrumbs'][] = ['label' => 'Waktu Pengumumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->waktu_pengumuman_id, 'url' => ['view', 'waktu_pengumuman_id' => $model->waktu_pengumuman_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="waktu-pengumuman-update">
    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
        'jenisTest' => $jenisTest,
    ]) ?>

</div>