<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BidangUtbk $model */
/** @var yii\widgets\ActiveForm $form */
$js = <<<JS
$(document).ready(function() {
    
    $('#reservationdate-mulai').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#reservationdate-berakhir').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#reservationdate-ujian').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#jamMulaiPicker').datetimepicker({
        format: 'HH:mm', 
        stepping: 5 
    });
    $('#jamSelesaiPicker').datetimepicker({
        format: 'HH:mm',
        stepping: 5 
    });

    $(".select2").select2({
        width: '100%' 
    });
});
JS;
$this->registerJs($js);
?>

<div class="bidang-utbk-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" for="kategori-bidang-utbk">Kategori Bidang Utbk</label>
                    <select class="form-control select2" id="kategori-bidang-utbk" name="BidangUtbk[kategori_bidang_utbk_id]">
                        <option value="">Pilih Kategori Bidang UTBK</option>
                        <?php foreach ($kategoriBidangUtbk as $kategori) : ?>
                            <option value="<?= Html::encode($kategori['kategori_bidang_utbk_id']); ?>" <?= $model->kategori_bidang_utbk_id == $kategori['kategori_bidang_utbk_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($kategori['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
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

<style>
    .select2-container--default .select2-selection--single {
        height: auto;

    }

    .input-group .form-control,
    .input-group .input-group-append {
        height: 38px;
    }

    .input-group {
        width: 100%;
    }
</style>