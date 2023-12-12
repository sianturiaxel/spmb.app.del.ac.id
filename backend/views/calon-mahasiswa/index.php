<?php

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
    $('#datatables').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': '$dataUrl', 
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
               "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
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
        <table id="datatables" class="table table-bordered table-striped">
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