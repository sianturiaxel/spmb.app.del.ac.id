<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\InformasiDel $model */

$this->title = 'Update Informasi Del: ' . $model->informasi_del_id;
$this->params['breadcrumbs'][] = ['label' => 'Informasi Dels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->informasi_del_id, 'url' => ['view', 'informasi_del_id' => $model->informasi_del_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="informasi-del-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
