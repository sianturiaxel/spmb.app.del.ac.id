<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SekolahDapodik $model */

$this->title = 'Update Sekolah Dapodik';
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Dapodik', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sekolah-dapodik-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>