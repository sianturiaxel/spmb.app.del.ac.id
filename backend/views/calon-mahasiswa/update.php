<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CalonMahasiswa $model */

$this->title = 'Update Calon Mahasiswa: ' . $model->calon_mahasiswa_id;
$this->params['breadcrumbs'][] = ['label' => 'Calon Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->calon_mahasiswa_id, 'url' => ['view', 'calon_mahasiswa_id' => $model->calon_mahasiswa_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="calon-mahasiswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
