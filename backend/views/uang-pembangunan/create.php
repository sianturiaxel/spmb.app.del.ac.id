<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UangPembangunan $model */

$this->title = 'Create Uang Pembangunan';
$this->params['breadcrumbs'][] = ['label' => 'Uang Pembangunans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uang-pembangunan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
