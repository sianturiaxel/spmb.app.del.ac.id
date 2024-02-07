<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancara $model */

$this->title = 'Create Nilai Wawancara';
$this->params['breadcrumbs'][] = ['label' => 'Nilai Wawancaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-wawancara-create">
    <?= $this->render('_form', [
        'model' => $model,
        'pendaftar' => $pendaftar,
    ]) ?>

</div>