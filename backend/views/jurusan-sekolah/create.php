<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JurusanSekolah $model */

$this->title = 'Create Jurusan Sekolah';
$this->params['breadcrumbs'][] = ['label' => 'Jurusan Sekolah', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurusan-sekolah-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>