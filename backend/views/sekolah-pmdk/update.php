<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SekolahPmdk $model */

$this->title = 'Update Sekolah Pmdk';
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Pmdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sekolah-pmdk-update">

    <?= $this->render('_form', [
        'model' => $model,
        'sekolah' => $sekolah,
    ]) ?>

</div>