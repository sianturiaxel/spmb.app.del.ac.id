<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BerkasDaftarUlang $model */

$this->title = 'Create Berkas Daftar Ulang';
$this->params['breadcrumbs'][] = ['label' => 'Berkas Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="berkas-daftar-ulang-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>