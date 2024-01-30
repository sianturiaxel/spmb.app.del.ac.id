<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UangDaftarUlang $model */

$this->title = 'Update Uang Daftar Ulang: ';
$this->params['breadcrumbs'][] = ['label' => 'Uang Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uang-daftar-ulang-update">

    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
    ]) ?>

</div>