<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JenisKelamin $model */

$this->title = 'Update Jenis Kelamin: ' . $model->jenis_kelamin_id;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Kelamins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jenis_kelamin_id, 'url' => ['view', 'jenis_kelamin_id' => $model->jenis_kelamin_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-kelamin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
