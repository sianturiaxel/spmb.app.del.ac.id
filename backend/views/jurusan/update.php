<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Jurusan $model */

$this->title = 'Update Jurusan';
$this->params['breadcrumbs'][] = ['label' => 'Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurusan-update">
    <?= $this->render('_form', [
        'model' => $model,
        'fakultas' => $fakultas,
    ]) ?>

</div>