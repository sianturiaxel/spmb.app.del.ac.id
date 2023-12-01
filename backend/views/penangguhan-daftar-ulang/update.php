<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PenangguhanDaftarUlang $model */

$this->title = 'Update Penangguhan Daftar Ulang: ' . $model->penangguhan_daftar_ulang_id;
$this->params['breadcrumbs'][] = ['label' => 'Penangguhan Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penangguhan_daftar_ulang_id, 'url' => ['view', 'penangguhan_daftar_ulang_id' => $model->penangguhan_daftar_ulang_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penangguhan-daftar-ulang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
