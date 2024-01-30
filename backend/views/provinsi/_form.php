<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Provinsi $model */
/** @var yii\widgets\ActiveForm $form */
?>



<div class="provinsi-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'provinsi_id')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
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
</div>