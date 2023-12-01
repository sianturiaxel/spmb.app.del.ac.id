<?php

use yii\helpers\Html;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var backend\models\BiayaPendaftaran $model */

$js = <<<JS
$(document).ready(function() {
    
    $('form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize(); 

        $.ajax({
            url: $(this).attr('action'), 
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil disimpan.',
                        icon: 'success'
                    }).then(function() {
                        window.location.href = response.redirectUrl; 
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal menyimpan data.',
                        icon: 'error'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan pada server.',
                    icon: 'error'
                });
            }
        });
        console.log($(this).attr('action'));
    });

    $(".select2").select2();
        //Initialize Select2 Elements
        $(".select2bs4").select2({
          theme: "bootstrap",
          
    });

    function formatRupiahJS(angka) {
        return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
   
});
JS;
$this->registerJs($js);

?>
<div class="card-body">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">
                <i class="fas fa-coins mr-2"></i>
                Tambah Biaya Pendaftaran
            </h4>
        </div>
        <div class="card-body">
            <form action="<?= Url::to(['biaya-pendaftaran/create']) ?>" method="post">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->getCsrfToken(); ?>">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gelombang-pendaftaran-select">Gelombang Pendaftaran</label>
                        <select class="form-control select2" id="gelombang-pendaftaran-select" name="BiayaPendaftaran[gelombang_pendaftaran_id]">
                            <option value="">Pilih Gelombang Pendaftaran</option>
                            <?php foreach ($GelombangPendaftaran as $gelombang) : ?>
                                <option value="<?= Html::encode($gelombang['gelombang_pendaftaran_id']); ?>">
                                    <?= Html::encode($gelombang['desc']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="biaya_daftar">Biaya Daftar</label>
                        <input type="number" class="form-control" id="biaya_daftar" name="BiayaPendaftaran[biaya_daftar]" placeholder="Masukkan Biaya Daftar">
                    </div>
                </div>

                <div class="row justify-content-center mt-3">
                    <div class="col-auto">
                        <a href="<?= Url::to(['biaya-pendaftaran/index']) ?>" class="btn btn-warning" style="width:150px;">Kembali</a>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success" style="width:150px;">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card-header {
        background-color: #007bff;
        /* Atau warna lain yang sesuai dengan tema Anda */
        border-bottom: 1px solid #007bff;
        /* Memberikan efek border yang serasi dengan background */
    }

    .card-title {
        font-size: 1.5rem;
        /* Mengubah ukuran font */
        font-weight: bold;
        /* Membuat teks menjadi tebal */
        text-shadow: 2px 2px 4px #000000;
        /* Memberikan efek bayangan pada teks */
    }

    .card-title i {
        color: #ffd700;
        /* Warna untuk icon */
    }

    .select2-container--default .select2-selection--single {
        height: 38px;
        line-height: 38px;
    }

    .select2-container {
        width: 48% !important;
        /* Ini mengatur lebar container select2 menjadi full-width */
    }

    /* Menambahkan style khusus untuk mengatur lebar tetap select2 */
    .select2-selection--single {
        width: 300px;
        /* Atur ini sesuai dengan lebar yang diinginkan */
    }

    /* Pastikan untuk menyesuaikan class ini dengan class icon library yang Anda gunakan */
</style>