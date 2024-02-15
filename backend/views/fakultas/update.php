<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fakultas $model */

$this->title = 'Update Fakultas';
$this->params['breadcrumbs'][] = ['label' => 'Fakultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fakultas-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>