<?php

/** @var yii\web\View $this */

$this->title = 'SPMB IT DEL';
$js = <<<JS
 
$(document).ready(function() {
    $('#gelombang-pendaftar').on('change', function() {
        var jumlah = $(this).find(':selected').data('jumlah');
        
        if (jumlah === undefined || jumlah === null) {
            jumlah = '<?= htmlspecialchars($jumlahPendaftar) ?>';
        }

        $('#jumlah-pendaftar').text(jumlah);
    });


    $('#gelombang-pendaftar-lulus').on('change', function() {
        var jumlah = $(this).find(':selected').data('jumlah');

        if (jumlah === undefined || jumlah === null) {
            jumlah = '<?= htmlspecialchars($jumlahCalonMahasiswaSudahBayar) ?>';
        }

        $('#jumlah-pendaftar-lulus').text(jumlah); 
    });


    $('#gelombang-pendaftaran-calon-mahasiswa').on('change', function() {
        var jumlah = $(this).find(':selected').data('jumlah');

        if (jumlah === undefined || jumlah === null) {
            jumlah = '<?= htmlspecialchars($jumlahCalonMahasiswaSudahBayar) ?>';
        }

        $('#jumlah-calon-mahasiswa').text(jumlah); 
    });


    $(".select2").select2();
        $(".select2bs4").select2({
          theme: "bootstrap4",
          
    });
    
});

JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="jumlah-pendaftar"><?= htmlspecialchars($jumlahPendaftar) ?></h3>
                        <p>Jumlah Pendaftar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <select class="form-control select2" id="gelombang-pendaftar">
                        <option value="" data-jumlah="<?= htmlspecialchars($jumlahPendaftar) ?>">Semua Gelombang Pendaftaran</option>
                        <?php foreach ($gelombangPendaftaran as $gelombang) : ?>
                            <option value="<?= htmlspecialchars($gelombang['gelombang_pendaftaran_id']); ?>" data-jumlah="<?= htmlspecialchars($gelombang['jumlah']); ?>">
                                <?= htmlspecialchars($gelombang['desc']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="jumlah-pendaftar-lulus"><?= htmlspecialchars($jumlahCalonMahasiswaLulus) ?></h3>
                        <p>Jumlah Pendaftar Lulus</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <select class="form-control select2" id="gelombang-pendaftar-lulus">
                        <option value="" data-jumlah="<?= htmlspecialchars($jumlahCalonMahasiswaLulus) ?>">Semua Gelombang Pendaftaran</option>
                        <?php foreach ($gelombangPendaftaran1 as $gelombang) : ?>
                            <option value="<?= htmlspecialchars($gelombang['gelombang_pendaftaran_id']); ?>" data-jumlah="<?= htmlspecialchars($gelombang['jumlah']); ?>">
                                <?= htmlspecialchars($gelombang['desc']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3 id="jumlah-calon-mahasiswa"><?= htmlspecialchars($jumlahCalonMahasiswaSudahBayar) ?></h3>
                        <p>Jumlah Calon Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <select class="form-control select2" id="gelombang-pendaftaran-calon-mahasiswa">
                        <option value="" data-jumlah="<?= htmlspecialchars($jumlahCalonMahasiswaSudahBayar) ?>">Semua Gelombang Pendaftaran</option>
                        <?php foreach ($gelombangPendaftaran2 as $gelombang) : ?>
                            <option value="<?= htmlspecialchars($gelombang['gelombang_pendaftaran_id']); ?>" data-jumlah="<?= htmlspecialchars($gelombang['jumlah']); ?>">
                                <?= htmlspecialchars($gelombang['desc']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        line-height: 38px;
    }

    .select2-container {
        width: 100% !important;
        /* Ini mengatur lebar container select2 menjadi full-width */
    }

    /* Menambahkan style khusus untuk mengatur lebar tetap select2 */
    .select2-selection--single {
        width: 100%;
        /* Atur ini sesuai dengan lebar yang diinginkan */
    }
</style>