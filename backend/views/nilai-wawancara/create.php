<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancara $model */

$this->title = 'Create Nilai Wawancara';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Wawancaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-wawancara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
