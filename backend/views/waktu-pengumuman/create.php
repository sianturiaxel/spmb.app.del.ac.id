<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\WaktuPengumuman $model */

$this->title = 'Create Waktu Pengumuman';
$this->params['breadcrumbs'][] = ['label' => 'Waktu Pengumumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="waktu-pengumuman-create">
    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
        'jenisTest' => $jenisTest,
    ]) ?>

</div>