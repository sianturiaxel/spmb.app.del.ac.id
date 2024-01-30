<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Kabupaten $model */

$this->title = 'Create Kabupaten';
$this->params['breadcrumbs'][] = ['label' => 'Kabupatens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kabupaten-create">

    <?= $this->render('_form', [
        'model' => $model,
        'provinsi' => $provinsi,
    ]) ?>

</div>