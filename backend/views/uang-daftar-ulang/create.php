<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UangDaftarUlang $model */

$this->title = 'Create Uang Daftar Ulang';
$this->params['breadcrumbs'][] = ['label' => 'Uang Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uang-daftar-ulang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
