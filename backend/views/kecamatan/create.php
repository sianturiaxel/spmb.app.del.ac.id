<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Kecamatan $model */

$this->title = 'Create Kecamatan';
$this->params['breadcrumbs'][] = ['label' => 'Kecamatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kecamatan-create">
    <?= $this->render('_form', [
        'model' => $model,
        'kabupaten' => $kabupaten,
    ]) ?>

</div>