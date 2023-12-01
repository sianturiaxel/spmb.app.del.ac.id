<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiPsikotes $model */

$this->title = 'Update Nilai Psikotes: ' . $model->nilai_psikotes_id;
$this->params['breadcrumbs'][] = ['label' => 'Nilai Psikotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nilai_psikotes_id, 'url' => ['view', 'nilai_psikotes_id' => $model->nilai_psikotes_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nilai-psikotes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
