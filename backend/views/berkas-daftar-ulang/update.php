<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BerkasDaftarUlang $model */

$this->title = 'Update Berkas Daftar Ulang';
$this->params['breadcrumbs'][] = ['label' => 'Berkas Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="berkas-daftar-ulang-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>