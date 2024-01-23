<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PenangguhanDaftarUlang $model */

$this->title = 'Create Penangguhan Daftar Ulang';
$this->params['breadcrumbs'][] = ['label' => 'Penangguhan Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penangguhan-daftar-ulang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
