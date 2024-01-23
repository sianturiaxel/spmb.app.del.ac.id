<?php
// var_dump($sekolah);
// die();


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SekolahPmdk $model */
/** @var yii\widgets\ActiveForm $form */
$js = <<<JS
$(document).ready(function() {
    $(".select2").select2({     
        width: '100%' // Atur lebar Select2
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
                <div class="col-md-12">
                    <label class="control-label" for="sekolah-pmdk-select">Sekolah PMDK</label>
                    <select class="form-control select2" id="sekolah-pmdk-select" name="SekolahPmdk[sekolah_id]">
                        <option value="">Pilih Sekolah PMDK</option>
                        <?php foreach ($sekolah as $sk) : ?>
                            <option value="<?= Html::encode($sk['sekolah_id']); ?>" <?= $model->sekolah_id == $sk['sekolah_id'] ? 'selected' : '' ?>>
                                <?= Html::encode($sk['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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
        /* Atau nilai lain yang sesuai dengan form lain */
    }
</style>