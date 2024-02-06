<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UserRole $model */

$this->title = 'Create User Role';
$this->params['breadcrumbs'][] = ['label' => 'User Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-role-create">

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
        'role' => $role,
    ]) ?>

</div>