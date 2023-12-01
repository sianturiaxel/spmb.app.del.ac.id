<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CalonMahasiswa $model */

$this->title = 'Create Calon Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Calon Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calon-mahasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
