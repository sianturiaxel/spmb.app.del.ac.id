<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Pendaftar $model */
/** @var yii\widgets\ActiveForm $form */
$js = <<<JS
$(document).ready(function() {
    $('form').submit(function(event) {
        var gelombangPendaftaranId = $('#gelombang-pendaftaran-select').val();
       
    });

    $(".select2").select2({
        
        width: '100%' // Atur lebar Select2
        
    });
    
    $('.toggle-collapse').click(function() {
        // Ini mengganti ikon dari up ke down dan sebaliknya
        $(this).toggleClass('fa-chevron-up fa-chevron-down');

       
        $('.data-pribadi-body').slideToggle();
        $('.data-orangtua-body').slideToggle();
        $('.data-akademik-body').slideToggle();
        $('.data-adminstrasi-body').slideToggle();
    });
    
  
   
});
JS;
$this->registerJs($js);
?>

<div class="pendaftar-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="card-header" onclick="toggleSection('data-pribadi')">
                <h5>Data Pribadi <i id="icon-data-pribadi" class="fas fa-plus"></i></h5>
            </div>
            <div class="card-body" id="data-pribadi" style="display: none;">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label" for="gelombang-pendaftaran-select">Gelombang</label>
                        <select class="form-control select2" id="gelombang-pendaftaran-select" name="Pendaftar[gelombang_pendaftaran_id]">
                            <option value="">Pilih Gelombang</option>
                            <?php foreach ($gelombangPendaftaran as $gelombang) : ?>
                                <option value="<?= Html::encode($gelombang['gelombang_pendaftaran_id']); ?>" <?= $model->gelombang_pendaftaran_id == $gelombang['gelombang_pendaftaran_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($gelombang['desc']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'nisn')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'penerima_kps')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'no_kps')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="jenis-kelamin-select">Jenis Kelamin</label>
                        <select class="form-control select2" id="jenis-kelamin-select" name="Pendaftar[jenis_kelamin_id]">
                            <option value="">Pilih Jenis Kelamin</option>
                            <?php foreach ($jenisKelamin as $gender) : ?>
                                <option value="<?= Html::encode($gender['jenis_kelamin_id']); ?>" <?= $model->jenis_kelamin_id == $gender['jenis_kelamin_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($gender['desc']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'tanggal_lahir')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="agama-select">Agama</label>
                        <select class="form-control select2" id="agama-select" name="Pendaftar[agama_id]">
                            <option value="">Pilih Agama</option>
                            <?php foreach ($agama as $agama) : ?>
                                <option value="<?= Html::encode($agama['agama_id']); ?>" <?= $model->agama_id == $agama['agama_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($agama['desc']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'alamat')->textarea(['rows' => 3]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'kode_pos')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'kelurahan')->textInput(['maxlength' => true]) ?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="kecamatan-select">Kecamatan</label>
                        <select class="form-control select2" id="kecamatan-select" name="Pendaftar[alamat_kec]">
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach ($kecamatan as $kecamatan) : ?>
                                <option value="<?= Html::encode($kecamatan['kecamatan_id']); ?>" <?= $model->alamat_kec == $kecamatan['kecamatan_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($kecamatan['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="kabupaten-select">Kabupaten</label>
                        <select class="form-control select2" id="kabupaten-select" name="Pendaftar[alamat_kab]">
                            <option value="">Pilih Kabupaten</option>
                            <?php foreach ($kabupaten as $kabupaten) : ?>
                                <option value="<?= Html::encode($kabupaten['kabupaten_id']); ?>" <?= $model->alamat_kab == $kabupaten['kabupaten_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($kabupaten['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="provinsi-select">Provinsi</label>
                        <select class="form-control select2" id="provinsi-select" name="Pendaftar[alamat_prov]">
                            <option value="">Pilih Provinsi</option>
                            <?php foreach ($provinsi as $provinsi) : ?>
                                <option value="<?= Html::encode($provinsi['provinsi_id']); ?>" <?= $model->alamat_prov == $provinsi['provinsi_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($provinsi['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'no_telepon_rumah')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'no_telepon_mobile')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>

            <div class="card-header" onclick="toggleSection('data-orangtua')">
                <h5>Data Orangtua <i id="icon-data-orangtua" class="fas fa-plus"></i></h5>
            </div>

            <div class="card-body" id="data-orangtua" style="display: none;">
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'nama_ayah_kandung')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'nama_ibu_kandung')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'nik_ayah')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'nik_ibu')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'tanggal_lahir_ayah')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'tanggal_lahir_ibu')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="pendidikan-select">Pendidikan Ayah</label>
                        <select class="form-control select2" id="pendidikan-ayah-select" name="Pendaftar[pendidikan_ayah_id]">
                            <option value="">Pilih Pendidikan</option>
                            <?php foreach ($pendidikanAyah as $pendidikan) : ?>
                                <option value="<?= Html::encode($pendidikan['jenjang_pendidikan_id']); ?>" <?= $model->pendidikan_ayah_id == $pendidikan['jenjang_pendidikan_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($pendidikan['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="pendidikan-select">Pendidikan Ibu</label>
                        <select class="form-control select2" id="pendidikan-ibu-select" name="Pendaftar[pendidikan_ibu_id]">
                            <option value="">Pilih Pendidikan</option>
                            <?php foreach ($pendidikanIbu as $pendidikan) : ?>
                                <option value="<?= Html::encode($pendidikan['jenjang_pendidikan_id']); ?>" <?= $model->pendidikan_ibu_id == $pendidikan['jenjang_pendidikan_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($pendidikan['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="kecamatan-orangtua-select">Kecamatan</label>
                        <select class="form-control select2" id="kecamatan-orangtua-select" name="Pendaftar[alamat_kec_orangtua]">
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach ($kecamatanOrangtua as $kecamatan) : ?>
                                <option value="<?= Html::encode($kecamatan['kecamatan_id']); ?>" <?= $model->alamat_kec_orangtua == $kecamatan['kecamatan_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($kecamatan['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="kabupaten-orangtua-select">Kabupaten</label>
                        <select class="form-control select2" id="kabupaten-orangtua-select" name="Pendaftar[alamat_kab_orangtua]">
                            <option value="">Pilih Kabupaten</option>
                            <?php foreach ($kabupatenOrangtua as $kabupaten) : ?>
                                <option value="<?= Html::encode($kabupaten['kabupaten_id']); ?>" <?= $model->alamat_kab_orangtua == $kabupaten['kabupaten_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($kabupaten['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="provinsi-orangtua-select">Provinsi</label>
                        <select class="form-control select2" id="provinsi-orangtua-select" name="Pendaftar[alamat_prov_orangtua]">
                            <option value="">Pilih Provinsi</option>
                            <?php foreach ($provinsiOrangtua as $provinsi) : ?>
                                <option value="<?= Html::encode($provinsi['provinsi_id']); ?>" <?= $model->alamat_prov_orangtua == $provinsi['provinsi_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($provinsi['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'alamat_orang_tua')->textarea(['rows' => 3]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'kode_pos_orang_tua')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label" for="pekerjaan-ayah-select">Pekerjaan Ayah</label>
                        <select class="form-control select2" id="pekerjaan-ayah-select" name="Pendaftar[pekerjaan_ayah_id]">
                            <option value="">Pilih Pekerjaan</option>
                            <?php foreach ($pekerjaanAyah as $pekerjaan) : ?>
                                <option value="<?= Html::encode($pekerjaan['pekerjaan_id']); ?>" <?= $model->pekerjaan_ayah_id == $pekerjaan['pekerjaan_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($pekerjaan['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="pekerjaan-ibu-select">Pekerjaan Ibu</label>
                        <select class="form-control select2" id="pekerjaan-ibu-select" name="Pendaftar[pekerjaan_ibu_id]">
                            <option value="">Pilih Pekerjaan</option>
                            <?php foreach ($pekerjaanIbu as $pekerjaan) : ?>
                                <option value="<?= Html::encode($pekerjaan['pekerjaan_id']); ?>" <?= $model->pekerjaan_ibu_id == $pekerjaan['pekerjaan_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($pekerjaan['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, 'penghasilan_ayah')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, 'penghasilan_ibu')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, 'penghasilan_total')->textInput() ?>
                    </div>
                </div>
            </div>

            <div class="card-header" onclick="toggleSection('data-akademik')">
                <h5>Data Akademik <i id="icon-data-akademik" class="fas fa-plus"></i></h5>
            </div>
            <div class="card-body" id="data-akademik" style="display: none;">
                <div class="row">
                    <div class="col-md-4">
                        <?php if ($model->sekolahId) : ?>
                            <div class="form-group">
                                <label class="control-label">Nama Sekolah</label>
                                <input type="text" class="form-control" value="<?= $model->sekolahId->sekolah ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'jurusan_sekolah')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'akreditasi_sekolah')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php if ($model->kemampuanBahasaInggris) : ?>
                            <div class="form-group">
                                <label class="control-label">Kemampuan Bahasa Inggris</label>
                                <input type="text" class="form-control" value="<?= $model->kemampuanBahasaInggris->desc ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'bahasa_asing_lainnya')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?php if ($model->kemampuanBahasaAsing) : ?>
                            <div class="form-group">
                                <label class="control-label">Kemampuan Bahasa Lainnya</label>
                                <input type="text" class="form-control" value="<?= $model->kemampuanBahasaAsing->desc ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card-header" onclick="toggleSection('data-adminstrasi')">
                <h5>Data Adminstrasi <i id="icon-data-adminstrasi" class="fas fa-plus"></i></h5>
            </div>
            <div class="card-body" id="data-adminstrasi" style="display: none;">
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'tanggal_pendaftaran')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="metode-pembayaran-select">Metode Pembayaran</label>
                        <select class="form-control select2" id="metode-pembayaran-select" name="Pendaftar[metode_pembayaran_id]">
                            <option value="">Pilih Metode Pembayaran</option>
                            <?php foreach ($metodePembayaran as $pembayaran) : ?>
                                <option value="<?= Html::encode($pembayaran['metode_pembayaran_id']); ?>" <?= $model->metode_pembayaran_id == $pembayaran['metode_pembayaran_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($pembayaran['desc']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="status-pendaftaran-select">Metode Pembayaran</label>
                        <select class="form-control select2" id="status-pendaftaran-select" name="Pendaftar[status_pendaftaran_id]">
                            <option value="">Pilih Metode Pembayaran</option>
                            <?php foreach ($statusPendaftaran as $pendaftaran) : ?>
                                <option value="<?= Html::encode($pendaftaran['status_pendaftaran_id']); ?>" <?= $model->status_pendaftaran_id == $pendaftaran['status_pendaftaran_id'] ? 'selected' : '' ?>>
                                    <?= Html::encode($pendaftaran['desc']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'prefix_kode_pendaftaran')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <?= $form->field($model, 'file_nilai_rapor')->fileInput() ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-7">
                        <?= $form->field($model, 'motivasi')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="col-md-5">
                        <?= $form->field($model, 'hobby')->textInput(['maxlength' => true]) ?>
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
        /* Atau nilai lain yang sesuai dengan form lain */
    }

    .data-pribadi-section {
        border-bottom: 2px solid #ccc;
        /* Gaya garis pemisah */
        margin-bottom: 20px;
        /* Jarak antara bagian */
        padding-bottom: 20px;
        /* Jarak padding di bawah bagian */
    }

    .data-orangtua-section {
        border-bottom: 2px solid #ccc;
        /* Gaya garis pemisah */
        margin-bottom: 20px;
        /* Jarak antara bagian */
        padding-bottom: 20px;
        /* Jarak padding di bawah bagian */
    }

    .data-orangtua-akademik {
        border-bottom: 2px solid #ccc;
        /* Gaya garis pemisah */
        margin-bottom: 20px;
        /* Jarak antara bagian */
        padding-bottom: 20px;
        /* Jarak padding di bawah bagian */
    }

    .data-orangtua-adminstrasi {
        border-bottom: 2px solid #ccc;
        /* Gaya garis pemisah */
        margin-bottom: 20px;
        /* Jarak antara bagian */
        padding-bottom: 20px;
        /* Jarak padding di bawah bagian */
    }


    .section-title {
        margin-top: 0;
        margin-bottom: 20px;
        color: #5b9bd5;
        /* Warna judul */
        font-family: 'Arial', sans-serif;
        /* Jenis font */
        font-size: 24px;
        /* Ukuran font */
        font-weight: bold;
        /* Keboldan font */
        text-transform: uppercase;
        /* Kapitalisasi teks */
        position: relative;
        /* Untuk positioning elemen tambahan seperti ikon */
    }

    /* Opsi: Menambahkan ikon sebelum judul menggunakan pseudo-element */
    .section-title::before {
        content: '\f007';
        /* Unicode karakter FontAwesome, misalnya */
        font-family: 'FontAwesome';
        /* Pastikan Anda memuat FontAwesome atau library ikon lainnya */
        margin-right: 10px;
        color: #5b9bd5;
        /* Sesuaikan warna ikon */
    }

    .card-header {
        cursor: pointer;
    }

    .card-header h5 {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<script>
    function toggleSection(sectionId) {
        var section = document.getElementById(sectionId);
        var icon = document.getElementById('icon-' + sectionId);

        if (section.style.display === 'none') {
            section.style.display = '';
            icon.classList.remove('fa-plus');
            icon.classList.add('fa-minus');
        } else {
            section.style.display = 'none';
            icon.classList.remove('fa-minus');
            icon.classList.add('fa-plus');
        }
    }
</script>