<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SekolahPmdk $model */

$this->title = 'Create Sekolah Pmdk';
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Pmdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sekolah-pmdk-create">
    <?= $this->render('_form', [
        'model' => $model,
        'sekolah' => $sekolah,
    ]) ?>

</div>