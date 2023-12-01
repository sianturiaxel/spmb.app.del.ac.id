<?php

use backend\models\Pendaftar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PendaftarSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$dataUrl            = Url::to(['pendaftar/data-for-datatables']);
$lulusAadminstrasi  = Url::to(['pendaftar/lulus-adminstrasi']);
$lulusAkademik      = Url::to(['pendaftar/lulus-akademik']);
$lulusWawancara     = Url::to(['pendaftar/lulus-wawancara']);
$lulusPsikotes      = Url::to(['pendaftar/lulus-psikotes']);
$kelulusan          = Url::to(['pendaftar/kelulusan']);
$pilihanJurusan     = Url::to(['pendaftar/get-pilihan-jurusan']);
$updatePilihanJurusan     = Url::to(['pendaftar/update-lulus']);
$LulusJurusan     = Url::to(['pendaftar/lulus-jurusan']);
$this->title = 'Pendaftar  SPMB IT Del';
$dataProvider->pagination = false;

$js = <<<JS

$(document).ready(function() {
    let tombolKelulusanDiklik = false;
    var table = $('#datatables').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            'url': '$dataUrl',
            'data': function(d) {
                var jalurPendaftaranFilter = $('#jalur-pendaftaran-select').val();
                if (jalurPendaftaranFilter) { 
                    d.jalur_pendaftaran_id = jalurPendaftaranFilter;
                }
            },
        },
        'columns': [
            { 'data': 'no' }, 
            { 'data': 'no_pendaftaran' },
            { 'data': 'nama_pendaftar' },
            { 'data': 'nama_sekolah' },
            { 'data': 'lokasi_ujian' },
            { 'data': 'kode_ujian' },
            { 'data': 'action'},
            { 'data': null, 'defaultContent': '' }
        ],
        'columnDefs': [
            {
                'targets': 7, 
                'render': function (data, type, row) {
                    return '<input type="checkbox" class="pendaftar-checkbox" value="' + row.no + '">';
                },

                'orderable': false,
                'searchable': false  
            },

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
               "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    });
    

    
    $('#apply-filter').on('click', function() {
        table.ajax.reload();
    });
   
    $('#status-filter').hide();
    
    $('#tombol-lulus-adminstrasi').on('click', function() {
    
        if ($(this).text() === "Pilih Lulus Adminstrasi") {
            
            table.on('preXhr.dt', function(e, settings, data) {
                data.status_adminstrasi_id = '0'; 
            });
            table.ajax.reload(null, false); 

            $(this).text("Luluskan");
        } else if ($(this).text() === "Luluskan") {
            var selectedIds = $('.pendaftar-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length > 0) {
                $.ajax({
                    url: '$lulusAadminstrasi',
                    type: 'POST',
                    data: {
                        ids: selectedIds,
                        _csrf: yii.getCsrfToken()
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            table.ajax.reload();
                        } else {
                            alert('Gagal meluluskan pendaftar.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: ", xhr.responseText);
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            } else {
                alert('Silakan pilih setidaknya satu pendaftar.');
            }
        }
    });
    $('#tombol-lulus-akademik').on('click', function() {
    
        if ($(this).text() === "Pilih Lulus Akademik") {
                
                table.on('preXhr.dt', function(e, settings, data) {
                    data.status_test_akademik_id = '0'; 
                });
                table.ajax.reload(null, false); 

                $(this).text("Luluskan");
            } else if ($(this).text() === "Luluskan") {
                var selectedIds = $('.pendaftar-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    $.ajax({
                        url: '$lulusAkademik',
                        type: 'POST',
                        data: {
                            ids: selectedIds,
                            _csrf: yii.getCsrfToken()
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                // Reload data di tabel
                                table.ajax.reload();
                            } else {
                                alert('Gagal meluluskan pendaftar.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: ", xhr.responseText);
                            alert('Terjadi kesalahan: ' + error);
                        }
                    });
                } else {
                    alert('Silakan pilih setidaknya satu pendaftar.');
                }
            }
    });
    $('#tombol-lulus-wawancara').on('click', function() {
        if ($(this).text() === "Pilih Lulus Wawancara") {
            table.on('preXhr.dt', function(e, settings, data) {
            data.status_wawancara_id = '0';
            data.status_adminstrasi_id = '1';
        });
        table.ajax.reload(null, false);

            $(this).text("Luluskan");
        } else if ($(this).text() === "Luluskan") {
            var selectedIds = $('.pendaftar-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length > 0) {
                $.ajax({
                    url: '$lulusWawancara', 
                    type: 'POST',
                    data: {
                        ids: selectedIds,
                        _csrf: yii.getCsrfToken() 
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            table.ajax.reload();
                        } else {
                            alert('Gagal meluluskan pendaftar.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: ", xhr.responseText);
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            } else {
                alert('Silakan pilih setidaknya satu pendaftar.');
            }
        }
    });
    $('#tombol-lulus-psikotes').on('click', function() {
        if ($(this).text() === "Pilih Lulus Psikotes") {
            var jalurTerpilih = $('#jalur-pendaftaran-select').val();

            table.on('preXhr.dt', function(e, settings, data) {
                data.status_test_psikologi_id = '0';
                if (jalurTerpilih == '1' || jalurTerpilih == '2') { 
                    data.status_adminstrasi_id = '1'; 
                    data.status_wawancara_id = '1'; 
                } else if (jalurTerpilih == '3') { 
                    data.status_test_akademik_id = '1';
                } else if (jalurTerpilih == '4') { 
                    data.status_adminstrasi_id = '1'; 
                }
            });
            table.ajax.reload(null, false); 

            $(this).text("Luluskan");
        } else if ($(this).text() === "Luluskan") {
            var selectedIds = $('.pendaftar-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length > 0) {
                $.ajax({
                    url: '$lulusPsikotes',
                    type: 'POST',
                    data: {
                        ids: selectedIds,
                        _csrf: yii.getCsrfToken()
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            table.ajax.reload();
                        } else {
                            alert('Gagal meluluskan pendaftar.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: ", xhr.responseText);
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            } else {
                alert('Silakan pilih setidaknya satu pendaftar.');
            }
        }
    });  

    $('#tombol-status-kelulusan').on('click', function() {
        if ($(this).text() === "Pilih Status Kelulusan") {
            tombolKelulusanDiklik = !tombolKelulusanDiklik; 
            var jalurTerpilih = $('#jalur-pendaftaran-select').val();
            table.on('preXhr.dt', function(e, settings, data) {
                if (jalurTerpilih == '1' || jalurTerpilih == '2') { 
                    data.status_adminstrasi_id = '1'; 
                    data.status_wawancara_id = '1'; 
                    data.status_test_psikologi_id = '1'; 
                } else if (jalurTerpilih == '3') { 
                    data.status_test_akademik_id = '1'; 
                    data.status_test_psikologi_id = '1'; 
                } else if (jalurTerpilih == '4') { 
                    data.status_adminstrasi_id = '1'; 
                    data.status_test_psikologi_id = '1'; 
                }
            });
            table.ajax.reload(null, false); 

            $(this).text("Luluskan");
        } else if ($(this).text() === "Luluskan") {
            var selectedIds = $('.pendaftar-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            
            if (selectedIds.length > 0) {
                $.ajax({
                    url: '$kelulusan',
                    type: 'POST',
                    data: {
                        ids: selectedIds,
                        _csrf: yii.getCsrfToken(),           
                    },
                    
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            // Reload data di tabel
                            table.ajax.reload();
                        } else {
                            alert('Gagal meluluskan pendaftar.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: ", xhr.responseText);
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            } else {
                alert('Silakan pilih setidaknya satu pendaftar.');
            }
        }
    });
    
    $('#jalur-pendaftaran-select').on('change', function() {
        
        var jalurTerpilih = $(this).val();

        $('#tombol-lulus-adminstrasi, #tombol-lulus-akademik, #tombol-lulus-wawancara, #tombol-lulus-psikotes, #tombol-status-kelulusan').hide();

        if (jalurTerpilih == '1') {
            $('#tombol-lulus-adminstrasi, #tombol-lulus-wawancara, #tombol-lulus-psikotes, #tombol-status-kelulusan').show();
        } else if (jalurTerpilih == '2') {
            $('#tombol-lulus-adminstrasi, #tombol-lulus-wawancara, #tombol-lulus-psikotes, #tombol-status-kelulusan').show();
        }
        else if (jalurTerpilih == '3') {
            $('#tombol-lulus-akademik, #tombol-lulus-psikotes, #tombol-status-kelulusan').show();
        }
        else if (jalurTerpilih == '4') {
            $('#tombol-lulus-adminstrasi, #tombol-lulus-psikotes, #tombol-status-kelulusan').show();
        }
        table.ajax.reload();
        
    });

    $(document).on('click', '.luluskan-button', function(e) {
        e.preventDefault();
        var pendaftarId = $(this).data('pendaftar-id');
        
        var modalBody = $('#detailJurusan').data('pendaftar-id', pendaftarId);
        var selectJurusan = $('.selectjurusan'); selectJurusan.empty();

        $.ajax({
            url: '$pilihanJurusan',
            type: 'GET',
            data: { pendaftar_id: pendaftarId },
            success: function(data) {
                
                if (Array.isArray(data.pilihanJurusan) && data.pilihanJurusan.length > 0) {
                    var pendaftarData = data.pilihanJurusan[0]; // Mengambil data pendaftar dari pilihan pertama
                    $('#modalNama').text(pendaftarData.namaPendaftar);
                    $('#modalNik').text(pendaftarData.nikPendaftar || 'Tidak tersedia');
                    $('#modalJurusan1').text(data.pilihanJurusan[0] ? data.pilihanJurusan[0].namaJurusan : '-');
                    $('#modalJurusan2').text(data.pilihanJurusan[1] ? data.pilihanJurusan[1].namaJurusan : '-');
                    $('#modalJurusan3').text(data.pilihanJurusan[2] ? data.pilihanJurusan[2].namaJurusan : '-');
                    
                    data.pilihanJurusan.forEach(function(pilihan, index) {
                        if (index === 0) $('#modalJurusan1').text(pilihan.namaJurusan);
                        if (index === 1) $('#modalJurusan2').text(pilihan.namaJurusan);
                        if (index === 2) $('#modalJurusan3').text(pilihan.namaJurusan);
                    });
                    
                    data.pilihanJurusan.forEach(function(pilihan) {
                        //console.log(pilihan.idJurusan, pilihan.namaJurusan); // Debugging
                        selectJurusan.append($('<option></option>')
                            .attr('value', pilihan.idJurusan)
                            .text(pilihan.namaJurusan)); // Pastikan 'namaJurusan' adalah nama field yang sesuai dari response
                        });
                } else {
                    // Jika tidak ada data pilihan jurusan, isi dengan '-'
                    $('#modalNama').text('-');
                    $('#modalNik').text('-');
                    $('#modalJurusan1').text('-');
                    $('#modalJurusan2').text('-');
                    $('#modalJurusan3').text('-');
                }

                $('#detailJurusan').modal('show');
            },
            
            error: function(xhr, status, error) {
                console.error("Error: ", xhr.responseText);
                modalBody.append('<p>Error saat memuat data.</p>');
            }
        });
    });

    $('#btnSimpanLulus').on('click', function() {
        var pendaftarId = $('#detailJurusan').data('pendaftar-id');
        console.log("Pendaftar ID: ", pendaftarId);
        var idJurusan = $('.selectjurusan').val(); 
        console.log("Jurusan ID: ", idJurusan);
        $.ajax({
            url: '$updatePilihanJurusan', 
            type: 'POST',
            data: {
                pendaftar_id: pendaftarId,  
                jurusan_id: idJurusan
            },
            success: function(response) {
                if (response.success) {
                    alert('Data berhasil disimpan.');
                    $('#detailJurusan').modal('hide');
                    location.reload();
                } else {
                    alert('Gagal menyimpan data.');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: ", xhr.responseText);
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
    });

    $(document).on('click', '.lulus-pada-jurusan', function(e) {
        e.preventDefault();
        var pendaftarId = $(this).data('pendaftar-id');
        
        $.ajax({
            url: '$LulusJurusan',
            type: 'GET',
            data: { pendaftar_id: pendaftarId },
            success: function(data) {
                //console.log("Data respons:", data);

                if (data && Array.isArray(data.pilihanJurusan) && data.pilihanJurusan.length > 0) {
                    var jurusanDiluluskan = 'Tidak ada jurusan';
                    var namaPendaftar = data.pilihanJurusan[0].namaPendaftar;
                    var nikPendaftar = data.pilihanJurusan[0].nikPendaftar;

                    data.pilihanJurusan.forEach(function(pilihan) {
                        if (pilihan.lulus === 1) {
                            jurusanDiluluskan = pilihan.namaJurusan;
                        }
                    });

                    $('#NamaCalonMahasiswa').text(namaPendaftar || 'Tidak tersedia');
                    $('#NikCalonMahasiswa').text(nikPendaftar || 'Tidak tersedia');
                    $('#modalJurusanLulus').text(jurusanDiluluskan);

                    $('#lulusjurusan').modal('show');
                } else {
                    console.log('Data tidak ditemukan atau terjadi kesalahan.');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: ", xhr.responseText);
                alert('Terjadi kesalahan saat memuat data.');
            },
        });
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
    
});



JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
<div class="card">
    <div class="card-body">
        <div class="flex-container">

            <select class="form-control select2" id="jalur-pendaftaran-select">
                <option value="">Semua Jalur Pendaftaran</option>
                <?php foreach ($jalurPendaftaran as $jalur) : ?>
                    <option value="<?= htmlspecialchars($jalur['jalur_pendaftaran_id']); ?>">
                        <?= htmlspecialchars($jalur['desc']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <?= Html::button('Pilih Lulus Adminstrasi', ['id' => 'tombol-lulus-adminstrasi', 'class' => 'btn btn-primary tombol-jalur']) ?>
            <?= Html::button('Pilih Lulus Akademik', ['id' => 'tombol-lulus-akademik', 'class' => 'btn btn-primary tombol-jalur']) ?>
            <?= Html::button('Pilih Lulus Wawancara', ['id' => 'tombol-lulus-wawancara', 'class' => 'btn btn-primary tombol-jalur']) ?>
            <?= Html::button('Pilih Lulus Psikotes', ['id' => 'tombol-lulus-psikotes', 'class' => 'btn btn-primary tombol-jalur']) ?>
            <?= Html::button('Pilih Status Kelulusan', ['id' => 'tombol-status-kelulusan', 'class' => 'btn btn-primary tombol-jalur']) ?>
            <?= Html::a('Download Lulus Adminstrasi', ['export-excel'], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Apakah Anda Ingin Mendownload Pendaftar Yang Lulus Adminstrasi?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>
<div class="card-body">
    <table id="datatables" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>No Pendaftaran</th>
                <th>Nama</th>
                <th>Nama Sekolah</th>
                <th>Lokasi Ujian</th>
                <th>Kode Ujian</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailJurusan" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Pilihan Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td id="modalNama"></td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>:</td>
                        <td id="modalNik"></td>
                    </tr>
                    <tr>
                        <th>Pilihan Jurusan 1</th>
                        <td>:</td>
                        <td id="modalJurusan1"></td>
                    </tr>
                    <tr>
                        <th>Pilihan Jurusan 2</th>
                        <td>:</td>
                        <td id="modalJurusan2"></td>
                    </tr>
                    <tr>
                        <th>Pilihan Jurusan 3</th>
                        <td>:</td>
                        <td id="modalJurusan3"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Pilih Jurusan:</label>
                                <div class="col-sm-5">
                                    <select class="form-control selectjurusan" style="width: 100%">
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Tempat untuk pilihan jurusan akan ditambahkan di sini -->

                </tbody>
            </table>
            <div class="modal-body">
                <!-- Data akan dimuat ke sini melalui JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSimpanLulus" class="btn btn-primary">Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lulusjurusan" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Ditempatkan Di Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td id="NamaCalonMahasiswa"></td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>:</td>
                        <td id="NikCalonMahasiswa"></td>
                    </tr>
                    <tr>
                        <th>Lulus Pada Jurusan</th>
                        <td>:</td>
                        <td id="modalJurusanLulus"></td>
                    </tr>
                </tbody>
            </table>
            <div class="modal-body">
                <!-- Data akan dimuat ke sini melalui JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<style>
    .flex-container {
        display: flex;
        align-items: stretch;
        gap: 10px;
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
        width: 200px;
        /* Atur ini sesuai dengan lebar yang diinginkan */
    }

    .tombol-jalur {
        display: none;
        /* Sembunyikan semua tombol di awal */
    }
</style>