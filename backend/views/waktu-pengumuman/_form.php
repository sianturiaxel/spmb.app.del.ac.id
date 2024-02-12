<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\WaktuPengumuman $model */
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
    
    $(".select2").select2({
        width: '100%' 
    });
});
JS;
$this->registerJs($js);
?>

<div class="waktu-pengumuman-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" for="gelombang-pendaftaran-select">Gelombang Pendaftaran</label>
                    <select class="form-control select2" id="gelombang-pendaftaran-select" name="WaktuPengumuman[gelombang_pendaftaran_id]">
                        <option value="">Pilih Gelombang Pendaftaran</option>
                        <?php foreach ($gelombangPendaftaran as $gelombang) : ?>
                            <option value="<?= Html::encode($gelombang['gelombang_pendaftaran_id']); ?>" <?= $model->gelombang_pendaftaran_id == $gelombang['gelombang_pendaftaran_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($gelombang['desc']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="jenis-test-select">Jenis Test</label>
                    <select class="form-control select2" id="jenis-test-select" name="WaktuPengumuman[jenis_test_id]">
                        <option value="">Pilih Jenis Tes</option>
                        <?php foreach ($jenisTest as $test) : ?>
                            <option value="<?= Html::encode($test['jenis_test_id']); ?>" <?= $model->jenis_test_id == $test['jenis_test_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($test['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div><br>
            <div class="row">
                <div class="col-md-4">
                    <label for="reservationdate-mulai">Tanggal Mulai</label>
                    <div class="input-group date" id="reservationdate-mulai" data-target-input="nearest">
                        <?= $form->field($model, 'tanggal_mulai')->textInput(['class' => 'form-control datetimepicker-input', 'data-target' => '#reservationdate-mulai'])->label(false) ?>
                        <div class="input-group-append" data-target="#reservationdate-mulai" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="reservationdate-berakhir">Tanggal Selesai</label>
                    <div class="input-group date" id="reservationdate-berakhir" data-target-input="nearest">
                        <?= $form->field($model, 'tanggal_akhir')->textInput(['class' => 'form-control datetimepicker-input', 'data-target' => '#reservationdate-berakhir'])->label(false) ?>
                        <div class="input-group-append" data-target="#reservationdate-berakhir" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'catatan')->textarea(['rows' => 6]) ?>
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