<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JurusanMapel $model */

$this->title = 'Create Jurusan Mapel';
$this->params['breadcrumbs'][] = ['label' => 'Jurusan Mapels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurusan-mapel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
