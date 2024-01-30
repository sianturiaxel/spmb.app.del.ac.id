<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UserRole $model */

$this->title = 'Update User Role';
$this->params['breadcrumbs'][] = ['label' => 'User Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-role-update">
    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
        'role' => $role,
    ]) ?>

</div>