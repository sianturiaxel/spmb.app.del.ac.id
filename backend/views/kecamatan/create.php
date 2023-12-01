<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Kecamatan $model */

$this->title = 'Create Kecamatan';
$this->params['breadcrumbs'][] = ['label' => 'Kecamatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kecamatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
