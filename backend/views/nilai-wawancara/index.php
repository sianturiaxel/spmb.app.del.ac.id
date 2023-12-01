<?php

use backend\models\NilaiWawancara;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\NilaiWawancaraSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$dataUrl = Url::to(['nilai-wawancara/data-for-datatables']);
$createUrl = Url::to(['create']);
$uploadUrl = Url::to(['nilai-wawancara/upload']);

$this->title = 'Nilai Wawancaras';
$dataProvider->pagination = false;

$js = <<<JS
$(document).ready(function() {
    $('#datatables').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': '$dataUrl', 
        'columns': [
            { 'data': 'no' }, 
            { 'data': 'pendaftar_id' },
            { 'data': 'nilai_motivasi' },
            { 'data': 'nilai_gambaran_karir' },
            { 'data': 'nilai_rekomendasi' },
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
               "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    });
    $('div.toolbar').html('<a href="$createUrl" class="btn btn-success">Tambah Data Nilai Wawancara</a>');
});
JS;

$this->registerJs($js, \yii\web\View::POS_READY);
?>
<div class="card">
    <div class="card-body">
        <div class="card-body">
            <form id="excel-upload-form" method="post" enctype="multipart/form-data" action="<?= Url::to(['nilai-wawancara/upload']) ?>">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="NilaiWawancara[excelFile]" accept=".xls,.xlsx" required>
                    <label class="custom-file-label" for="customFile">Choose Excel File</label>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
        <table id="datatables" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pendaftar</th>
                    <th>Nilai Motivasi</th>
                    <th>Nilai Gambar dan Karir</th>
                    <th>Nilai Rekomendasi</th>
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
</style>