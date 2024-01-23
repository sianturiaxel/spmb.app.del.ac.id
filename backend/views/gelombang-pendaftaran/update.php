<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GelombangPendaftaran $model */

$this->title = 'Update Gelombang Pendaftaran: ' . $model->gelombang_pendaftaran_id;
$this->params['breadcrumbs'][] = ['label' => 'Gelombang Pendaftarans', 'url' => ['index']];

?>
<div class="gelombang-pendaftaran-update">
    <?= $this->render('_form', [
        'model' => $model,
        'jenisUjian' => $jenisUjian,
    ]) ?>

</div>