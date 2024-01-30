<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Users $model */

$this->title = 'Update Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>