<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Role $model */

$this->title = 'Update Role';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>