<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fakultas $model */

$this->title = 'Create Fakultas';
$this->params['breadcrumbs'][] = ['label' => 'Fakultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fakultas-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>