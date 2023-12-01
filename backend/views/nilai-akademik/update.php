<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademik $model */

$this->title = 'Update Nilai Akademik: ' . $model->nilai_akademik_id;
$this->params['breadcrumbs'][] = ['label' => 'Nilai Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nilai_akademik_id, 'url' => ['view', 'nilai_akademik_id' => $model->nilai_akademik_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nilai-akademik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
