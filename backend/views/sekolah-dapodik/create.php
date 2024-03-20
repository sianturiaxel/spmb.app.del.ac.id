<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SekolahDapodik $model */

$this->title = 'Create Sekolah Dapodik';
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Dapodik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sekolah-dapodik-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>