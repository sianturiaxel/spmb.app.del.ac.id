<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\LokasiUjian $model */

$this->title = 'Create Lokasi Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Lokasi Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-ujian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
