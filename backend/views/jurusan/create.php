<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Jurusan $model */

$this->title = 'Create Jurusan';
$this->params['breadcrumbs'][] = ['label' => 'Jurusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurusan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fakultas' => $fakultas,
    ]) ?>

</div>