<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademik $model */

$this->title = 'Create Nilai Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-akademik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
