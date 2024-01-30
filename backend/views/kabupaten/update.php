<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Kabupaten $model */

$this->title = 'Update Kabupaten';
$this->params['breadcrumbs'][] = ['label' => 'Kabupatens', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kabupaten-update">
    <?= $this->render('_form', [
        'model' => $model,
        'provinsi' => $provinsi,
    ]) ?>

</div>