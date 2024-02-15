<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JenjangPendidikan $model */

$this->title = 'Update Jenjang Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Jenjang Pendidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenjang-pendidikan-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>