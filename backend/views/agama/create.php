<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Agama $model */

$this->title = 'Create Agama';
$this->params['breadcrumbs'][] = ['label' => 'Agamas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agama-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>