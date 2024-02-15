<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GolonganDarah $model */

$this->title = 'Update Golongan Darah';
$this->params['breadcrumbs'][] = ['label' => 'Golongan Darah', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="golongan-darah-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>