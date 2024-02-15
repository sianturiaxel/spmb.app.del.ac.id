<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JenjangPendidikan $model */

$this->title = 'Create Jenjang Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Jenjang Pendidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenjang-pendidikan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>