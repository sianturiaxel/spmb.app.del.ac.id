<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UangDaftarUlang $model */

$this->title = 'Create Uang Daftar Ulang';
$this->params['breadcrumbs'][] = ['label' => 'Uang Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uang-daftar-ulang-create">
    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
    ]) ?>

</div>