<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FincTFee $model */

$this->title = 'Create Finc T Fee';
$this->params['breadcrumbs'][] = ['label' => 'Finc T Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finc-tfee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
