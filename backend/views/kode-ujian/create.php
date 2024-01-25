<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\KodeUjian $model */

$this->title = 'Create Kode Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Kode Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="kode-ujian-create">

    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
        'jenisTest' => $jenisTest,
    ])
    ?>

</div>