<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\BerkasDaftarUlang $model */

$this->title = 'Update Berkas Daftar Ulang: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Berkas Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'berkas_daftar_ulang_id' => $model->berkas_daftar_ulang_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="berkas-daftar-ulang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
