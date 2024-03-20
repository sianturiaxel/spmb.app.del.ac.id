<?php
// var_dump($gelombangPendaftaran);
// die();

use backend\models\CalonMahasiswa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$dataUrl = Url::to(['calon-mahasiswa/data-for-datatables']);
/** @var yii\web\View $this */
/** @var backend\models\CalonMahasiswaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Calon Mahasiswa';
$dataProvider->pagination = false;

$js = <<<JS
$(document).ready(function() {
    var table = $('#datatables').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            'url': '$dataUrl',
            'data': function(d) {
                var gelombangPendaftaranFilter = $('#gelombang-pendaftaran-select').val();
                if (gelombangPendaftaranFilter) { 
                    d.gelombang_pendaftaran_id = gelombangPendaftaranFilter;
                }
            },
        },
        'columns': [
            { 'data': 'no' }, 
            { 'data': 'nama' },
            { 'data': 'nik' },
            { 'data': 'jalur_pendaftaran' },
            { 'data': 'jurusan' },
            { 'data': 'status_pembayaran' },
            { 'data': 'action', 'orderable': false, 'searchable': false }
        ],
        
        'paging': true,
        'lengthChange': true,
        'lengthMenu': [10, 20, 50, 100],
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false,
        'responsive': true,
        'pageLength': 10,
        'dom': "<'row'<'col-sm-12 col-md-4 toolbar'><'col-sm-12 col-md-8'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        
        'drawCallback': function(settings) {
            $('#datatables tbody tr').each(function() {
                var statusPembayaran = $(this).find('td:eq(5)').text().trim(); 
                if (statusPembayaran === 'Sudah Membayar') {
                    $(this).children('td').css('background-color', '#d4edda');
                } else if (statusPembayaran === 'Belum Membayar') {
                    $(this).children('td').css('background-color', '#f8d7da');
                }
            });
        }
    });

    

    $(".select2").select2();
        //Initialize Select2 Elements
        $(".select2bs4").select2({
          theme: "bootstrap4",
          
    });
    $(".selectjurusan").select2();
        //Initialize Select2 Elements
        $(".select2bs4").select2({
          theme: "bootstrap4",
          
    });
    $('#gelombang-pendaftaran-select').on('change', function() {
        var selectedText = $("#gelombang-pendaftaran-select option:selected").text().trim();
        console.log("Selected option text:", selectedText);

        var words = selectedText.split(' ');
        console.log("Words array:", words); 

        var desc = words[0];
        console.log("First word:", desc);
        
        table.ajax.reload();
        
    });

    $('#status-pembayaran-select').on('change', function() {
        var statusPembayaran = $(this).val();

        // Bangun URL baru untuk sumber data AJAX DataTables
        var newAjaxUrl = '$dataUrl'; // Ganti dengan URL ke action server-side DataTables Anda
        if (statusPembayaran !== '') {
            newAjaxUrl += (newAjaxUrl.includes('?') ? '&' : '?') + 'status_pembayaran=' + statusPembayaran;
        } else {
            // Jika "Tampilkan Semua Data" dipilih, hapus parameter dari URL
            var url = new URL(newAjaxUrl);
            url.searchParams.delete('status_pembayaran');
            newAjaxUrl = url.toString();
        }

        // Update sumber data AJAX untuk DataTables dan muat ulang data
        table.ajax.url(newAjaxUrl).load();
    });});
JS;

$this->registerJs($js, \yii\web\View::POS_READY);
?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <select class="form-control select2" id="gelombang-pendaftaran-select">
                    <option value="">Semua Gelombang Pendaftaran</option>
                    <?php foreach ($gelombangPendaftaran as $gelombang) : ?>
                        <option value="<?= htmlspecialchars($gelombang['gelombang_pendaftaran_id']); ?>">
                            <?= htmlspecialchars($gelombang['desc']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control select2" id="status-pembayaran-select">
                    <option value="">Status Pembayaran</option>
                    <option value="1" <?= (isset($queryParams['status_pembayaran']) && $queryParams['status_pembayaran'] === '1') ? 'selected' : '' ?>>Sudah Membayar</option>
                    <option value="0" <?= (isset($queryParams['status_pembayaran']) && $queryParams['status_pembayaran'] === '0') ? 'selected' : '' ?>>Belum Membayar</option>
                </select>
            </div>
        </div>
        <table id="datatables" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nik</th>
                    <th>Jalur Pendaftaran</th>
                    <th>Jurusan</th>
                    <th>Status Pembayaran</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>



<style>
    #datatables td {
        border: 1px solid #FFFFFF !important;
        /* Hanya gunakan ini sebagai upaya terakhir */
    }

    #datatables th:nth-child(2),
    #datatables td:nth-child(2) {
        /* untuk kolom 'No Pendaftaran' */
        width: 50px;

    }

    #datatables td:nth-child(7) {
        /* untuk kolom 'No Pendaftaran' */
        width: 75px;
    }


    .flex-item {
        margin-top: 20px;
        /* Atau berapa pun jarak yang Anda inginkan */
    }

    .flex-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        /* Jarak antar elemen */
    }

    .flex-item {
        flex: 1;
        /* Elemen mengambil ruang yang tersedia */
        min-width: 100%;
        /* Minimum lebar untuk setiap item */
    }

    /* Jika Anda ingin menyesuaikan tampilan untuk layar yang lebih kecil */
    @media (max-width: 768px) {
        .flex-item {
            flex-basis: 100%;
            /* Setiap item mengambil satu baris penuh pada layar kecil */
        }
    }

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

    .tombol-jalur {
        display: none;
        /* Sembunyikan semua tombol di awal */
    }

    .custom-button-spacing {
        margin-right: -110px;
        /* Sesuaikan jarak */
    }


    /* .pendaftar-checkbox {
        display: none;
    } */
</style>