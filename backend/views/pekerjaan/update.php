<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Pekerjaan $model */

$this->title = 'Update Pekerjaan';
$this->params['breadcrumbs'][] = ['label' => 'Pekerjaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pekerjaan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>