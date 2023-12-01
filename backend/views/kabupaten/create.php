<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Kabupaten $model */

$this->title = 'Create Kabupaten';
$this->params['breadcrumbs'][] = ['label' => 'Kabupatens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kabupaten-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
