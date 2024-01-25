<?php
// var_dump($gelombangPendaftaran);
// die();

use backend\models\KodeUjian;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\KodeUjianSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$dataUrl = Url::to(['kode-ujian/data-for-datatables']);
$updateStatus = Url::to(['kode-ujian/update-status']);
$createUrl = Url::to(['create']);
$uploadUrl = Url::to(['kode-ujian/upload']);
$this->title = 'Kode Ujian';
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
            { 'data': 'gelombang_pendaftaran' },
            { 'data': 'jenis_test' },
            { 'data': 'kode_ujian' },
            { 'data': 'status' },
            { 'data': 'action', 'orderable': false, 'searchable': false }
        ],
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false,
        'responsive': true,
        'dom': "<'row'<'col-sm-12 col-md-4 toolbar'><'col-sm-12 col-md-8'f>>" + 
            "<'row'<'col-sm-12'tr>>" + 
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    })
    $('div.toolbar').html('<a href=\"{$createUrl}\" class=\"btn btn-success\">Tambah Kode Ujian</a>');

    $('#gelombang-pendaftaran-select').on('change', function() {
        var selectedText = $("#gelombang-pendaftaran-select option:selected").text().trim();
        console.log("Selected option text:", selectedText);

        var words = selectedText.split(' ');
        console.log("Words array:", words); 

        var desc = words[0];
        console.log("First word:", desc);
        
       
        table.ajax.reload();
        
    });

    $('#datatables tbody').on('change', '.status-toggle', function() {
        var status = $(this).is(':checked') ? 1 : 0;
        var kode_ujian_id = $(this).data('id');
        console.log('Kode Ujian ID sent:', kode_ujian_id);
        console.log('Status sent:', status);


        $.ajax({
            url: '$updateStatus',
            type: 'POST',
            data: {
                'kode_ujian_id': kode_ujian_id,
                'status': status,
                '_csrf': yii.getCsrfToken()
            },
            success: function(response) {
                if (response.success) {
                    console.log('Status updated: ' + response.message);
                } else {
                    console.error('Failed to update status: ' + response.message);
                    if (response.errors) {
                        console.error(response.errors);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error: ' + error);
            }
        });
    });

    $(".select2").select2();
        $(".select2bs4").select2({
          theme: "bootstrap4",
          
    });
});
JS;
$this->registerJs($js);
?>


<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-2">
                <div class="pr-2">
                    <select class="form-control select2" id="gelombang-pendaftaran-select">
                        <option value="">Semua Gelombang Pendaftaran</option>
                        <?php foreach ($gelombangPendaftaran as $gelombang) : ?>
                            <option value="<?= htmlspecialchars($gelombang['gelombang_pendaftaran_id']); ?>">
                                <?= htmlspecialchars($gelombang['desc']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-10">
                <div class="pl-2">
                    <form id="excel-upload-form" method="post" enctype="multipart/form-data" action="<?= Url::to(['kode-ujian/upload']) ?>">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="KodeUjian[excelFile]" accept=".xls,.xlsx" required>
                            <label class="custom-file-label" for="customFile">Choose Excel File</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
        <table id="datatables" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gelombang Pendaftaran</th>
                    <th>Jenis Ujian</th>
                    <th>Kode Ujian</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<style>
    /* CSS untuk input file yang diubah menjadi tombol "Choose Excel File" */
    .custom-file {
        position: relative;
        display: inline-block;
        max-width: 18%;
        /* Mengatur lebar maksimum */
        margin-left: auto;
        /* Menggeser elemen ke kanan */
        margin-right: 10px;
        /* Menggeser elemen ke kanan */

    }

    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: 2.5rem;
        margin: 0;
        opacity: 0;
    }

    .custom-file-label {
        position: absolute;
        top: 0;
        right: 0;
        left: -20px;
        z-index: 1;
        height: 2.5rem;
        padding: 0.5rem 1rem;
        line-height: 1.5;
        color: #333;
        /* Ganti dengan warna teks yang Anda inginkan */
        background-color: #f0f0f0;
        /* Ganti dengan warna latar belakang yang Anda inginkan */
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    /* CSS untuk tombol "Upload" */
    .btn-primary {
        background-color: #007bff;
        /* Ganti dengan warna latar belakang yang Anda inginkan */
        color: #fff;
        /* Ganti dengan warna teks yang Anda inginkan */
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Ganti dengan warna latar belakang yang Anda inginkan saat hover */
        color: #fff;
        /* Ganti dengan warna teks yang Anda inginkan saat hover */
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

    /* Styling untuk switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>