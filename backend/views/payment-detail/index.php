<?php

use backend\models\PaymentDetail;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PaymentDetailSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$dataUrl = Url::to(['payment-detail/data-for-datatables']);
$createUrl = Url::to(['create']);
$js = <<<JS
$(document).ready(function() {
    $('#datatables').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': '$dataUrl', 
        'columns': [
            { 'data': 'no' }, 
            { 'data': 'calon_mahasiswa' },
            { 'data': 'total_ammount' },
            { 'data': 'fee_name' },
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
                    <th>Calon Mahasiswa</th>
                    <th>Total Ammount</th>
                    <th>Fee Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>