<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PindahLokasi $model */

$this->title = 'Create Pindah Lokasi';
$this->params['breadcrumbs'][] = ['label' => 'Pindah Lokasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pindah-lokasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
