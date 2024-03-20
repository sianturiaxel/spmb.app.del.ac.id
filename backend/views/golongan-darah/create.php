<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GolonganDarah $model */

$this->title = 'Create Golongan Darah';
$this->params['breadcrumbs'][] = ['label' => 'Golongan Darah', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="golongan-darah-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>