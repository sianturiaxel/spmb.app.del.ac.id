<?php
// var_dump($jenisUjian);
// die();

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\GelombangPendaftaran $model */
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

<div class="kode-ujian-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <label for="reservationdate-mulai">Mulai</label>
                    <div class="input-group date" id="reservationdate-mulai" data-target-input="nearest">
                        <?= $form->field($model, 'mulai')->textInput(['class' => 'form-control datetimepicker-input', 'data-target' => '#reservationdate-mulai'])->label(false) ?>
                        <div class="input-group-append" data-target="#reservationdate-mulai" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="reservationdate-berakhir">Berakhir</label>
                    <div class="input-group date" id="reservationdate-berakhir" data-target-input="nearest">
                        <?= $form->field($model, 'berakhir')->textInput(['class' => 'form-control datetimepicker-input', 'data-target' => '#reservationdate-berakhir'])->label(false) ?>
                        <div class="input-group-append" data-target="#reservationdate-berakhir" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'prefix_kode_pendaftaran')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'counter')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'is_online')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'is_bayar')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <label class="control-label" for="jenis-ujian-select">Jenis Ujian</label>
                    <select class="form-control select2" id="jenis-ujian-select" name="GelombangPendaftaran[jenis_ujian_id]">
                        <option value="">Pilih Jenis Ujian</option>
                        <?php foreach ($jenisUjian as $ujian) : ?>
                            <option value="<?= Html::encode($ujian['jenis_ujian_id']); ?>" <?= $model->jenis_ujian_id == $ujian['jenis_ujian_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($ujian['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'minimum_n')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'base_n')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'multi_n')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="reservationdate-ujian">Tanggal Ujian</label>
                    <div class="input-group date" id="reservationdate-ujian" data-target-input="nearest">
                        <?= $form->field($model, 'tanggal_ujian')->textInput(['class' => 'form-control datetimepicker-input', 'data-target' => '#reservationdate-ujian'])->label(false) ?>
                        <div class="input-group-append" data-target="#reservationdate-ujian" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="jamMulaiPicker">Jam Mulai</label>
                    <div class="input-group date" id="jamMulaiPicker" data-target-input="nearest">
                        <?= $form->field($model, 'jam_mulai')->textInput(['class' => 'form-control datetimepicker-input', 'data-target' => '#jamMulaiPicker'])->label(false) ?>
                        <div class="input-group-append" data-target="#jamMulaiPicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="jamSelesaiPicker">Jam Mulai</label>
                    <div class="input-group date" id="jamSelesaiPicker" data-target-input="nearest">
                        <?= $form->field($model, 'jam_selesai')->textInput(['class' => 'form-control datetimepicker-input', 'data-target' => '#jamSelesaiPicker'])->label(false) ?>
                        <div class="input-group-append" data-target="#jamSelesaiPicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
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