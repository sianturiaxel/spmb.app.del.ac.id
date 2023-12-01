<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UangDaftarUlang $model */

$this->title = 'Update Uang Daftar Ulang: ' . $model->uang_daftar_ulang_id;
$this->params['breadcrumbs'][] = ['label' => 'Uang Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uang_daftar_ulang_id, 'url' => ['view', 'uang_daftar_ulang_id' => $model->uang_daftar_ulang_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uang-daftar-ulang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
