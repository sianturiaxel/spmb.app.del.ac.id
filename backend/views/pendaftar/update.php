<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Pendaftar $model */

$this->title = 'Update Pendaftar: ' . $model->pendaftar_id;
$this->params['breadcrumbs'][] = ['label' => 'Pendaftars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pendaftar_id, 'url' => ['view', 'pendaftar_id' => $model->pendaftar_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pendaftar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
