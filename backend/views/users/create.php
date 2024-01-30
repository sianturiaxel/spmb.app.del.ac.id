<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Users $model */

$this->title = 'Create Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>