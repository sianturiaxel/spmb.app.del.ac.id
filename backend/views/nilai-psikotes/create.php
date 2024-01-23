<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiPsikotes $model */

$this->title = 'Create Nilai Psikotes';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Psikotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-psikotes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
