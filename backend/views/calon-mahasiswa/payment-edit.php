<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Payment Detail';
$this->params['breadcrumbs'][] = ['label' => 'Calon Mahasiswa', 'url' => ['calon-mahasiswa/index']];
$this->params['breadcrumbs'][] = ['label' => $model->calonMahasiswa->nama, 'url' => ['calon-mahasiswa/view', 'calon_mahasiswa_id' => $model->calon_mahasiswa_id]];
$this->params['breadcrumbs'][] = 'Edit Payment Detail';
?>
<div class="payment-detail-edit container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'fee_name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'total_amount')->textInput(['type' => 'number', 'step' => 'any']) ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <?= Html::button('Kembali', ['class' => 'btn btn-warning', 'onclick' => 'history.go(-1)']) ?>
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>