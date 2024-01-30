<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Provinsi $model */

$this->title = 'Update Provinsi';
$this->params['breadcrumbs'][] = ['label' => 'Provinsis', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="provinsi-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>