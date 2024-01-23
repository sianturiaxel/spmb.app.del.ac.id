<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\InformasiDel $model */

$this->title = 'Create Informasi Del';
$this->params['breadcrumbs'][] = ['label' => 'Informasi Dels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasi-del-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
