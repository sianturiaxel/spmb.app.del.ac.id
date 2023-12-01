<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Agama $model */

$this->title = 'Update Agama: ' . $model->agama_id;
$this->params['breadcrumbs'][] = ['label' => 'Agamas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->agama_id, 'url' => ['view', 'agama_id' => $model->agama_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agama-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
