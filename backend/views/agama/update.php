<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Agama $model */

$this->title = 'Update Agama';
$this->params['breadcrumbs'][] = ['label' => 'Agamas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agama-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>