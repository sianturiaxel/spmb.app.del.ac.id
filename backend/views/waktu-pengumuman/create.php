<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\WaktuPengumuman $model */

$this->title = 'Create Waktu Pengumuman';
$this->params['breadcrumbs'][] = ['label' => 'Waktu Pengumumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="waktu-pengumuman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
