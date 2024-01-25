<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JurusanMapel $model */

$this->title = 'Update Jurusan Mapel';
$this->params['breadcrumbs'][] = ['label' => 'Jurusan Mapels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jurusan_mapel_id, 'url' => ['view', 'jurusan_mapel_id' => $model->jurusan_mapel_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurusan-mapel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>