<?php

use backend\models\Kecamatan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$dataUrl = Url::to(['kecamatan/data-for-datatables']);
$createUrl = Url::to(['create']);
/** @var yii\web\View $this */
/** @var backend\models\KecamatanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kecamatan';
$dataProvider->pagination = false;

$js = <<<JS
$(document).ready(function() {
    $('#datatables').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': '$dataUrl', 
        'columns': [
            { 'data': 'no' }, 
            { 'data': 'kode_kabupaten' },
            { 'data': 'kode_kecamatan' },
            { 'data': 'nama_kecamatan' },
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
    $('div.toolbar').html('<a href="$createUrl" class="btn btn-success">Tambah Data Kabupaten</a>');
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
                    <th>Kode Kabupaten</th>
                    <th>Kode Kecamatan</th>
                    <th>Nama Kecamatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- http://localhost:8082/index.php?r=kecamatan%2Fview&kecamatan_id=1101 -->
<!-- http://localhost:8082/index.php?r=kecamatan%2Fview&kecamatan_id=1101010 -->