<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Kecamatan $model */

$this->title = 'Update Kecamatan';
$this->params['breadcrumbs'][] = ['label' => 'Kecamatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kecamatan-update">
    <?= $this->render('_form', [
        'model' => $model,
        'kabupaten' => $kabupaten,
    ]) ?>

</div>