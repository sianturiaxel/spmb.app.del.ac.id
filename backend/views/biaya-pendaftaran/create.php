<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\KodeUjian $model */

$this->title = 'Create Biaya Pendaftaran';
$this->params['breadcrumbs'][] = ['label' => 'Biaya Pendaftaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="biaya-pendaftaran-create">

    <?= $this->render('_form', [
        'model' => $model,
        'gelombangPendaftaran' => $gelombangPendaftaran,
        'feeId' => $feeId,
    ])
    ?>

</div>