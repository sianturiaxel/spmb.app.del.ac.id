<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancara $model */

$this->title = 'Update Nilai Wawancara: ' . $model->nilai_wawancara_id;
$this->params['breadcrumbs'][] = ['label' => 'Nilai Wawancaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nilai_wawancara_id, 'url' => ['view', 'nilai_wawancara_id' => $model->nilai_wawancara_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nilai-wawancara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
