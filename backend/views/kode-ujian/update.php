<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\KodeUjian $model */

$this->title = 'Update Kode Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Kode Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kode-ujian-update">
    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
        'jenisTest' => $jenisTest,
    ]) ?>

</div>