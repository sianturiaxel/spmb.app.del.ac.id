<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JurusanSekolah $model */

$this->title = 'Update Jurusan Sekolah';
$this->params['breadcrumbs'][] = ['label' => 'Jurusan Sekolah', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurusan-sekolah-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>