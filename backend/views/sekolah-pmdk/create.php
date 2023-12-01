<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SekolahPmdk $model */

$this->title = 'Create Sekolah Pmdk';
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Pmdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sekolah-pmdk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
