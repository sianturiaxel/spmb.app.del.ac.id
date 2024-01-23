<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Pendaftar $model */

$this->title = 'Create Pendaftar';
$this->params['breadcrumbs'][] = ['label' => 'Pendaftars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendaftar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
