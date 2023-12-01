<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Jurusan $model */

$this->title = 'Update Jurusan: ' . $model->jurusan_id;
$this->params['breadcrumbs'][] = ['label' => 'Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jurusan_id, 'url' => ['view', 'jurusan_id' => $model->jurusan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurusan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
