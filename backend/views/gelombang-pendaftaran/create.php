<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GelombangPendaftaran $model */

$this->title = 'Create Gelombang Pendaftaran';
$this->params['breadcrumbs'][] = ['label' => 'Gelombang Pendaftarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gelombang-pendaftaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
