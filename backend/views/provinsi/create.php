<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Provinsi $model */

$this->title = 'Create Provinsi';
$this->params['breadcrumbs'][] = ['label' => 'Provinsis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provinsi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
