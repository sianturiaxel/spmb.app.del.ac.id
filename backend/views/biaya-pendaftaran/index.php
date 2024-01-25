<?php

use backend\models\BiayaPendaftaran;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\BiayaPendaftaranSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Biaya Pendaftaran';
$dataProvider->pagination = false;
$createUrl = Url::to(['create']);
$view  = Url::to(['biaya-pendaftaran/view']);
$js = <<<JS
$(document).ready(function() {
    $(function () {
        $('#datatables').DataTable({
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
        $('div.toolbar').html('<a href=\"{$createUrl}\" class=\"btn btn-success\">Tambah Biaya Pendaftaran</a>');
    });

    function formatRupiahJS(angka) {
        return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $(document).on('click', '.view-button', function() {
        var biayaPendaftaranId = $(this).data('id');
        $.ajax({
            url: '$view',
            type: 'GET',
            data: { biaya_pendaftaran_id: biayaPendaftaranId },
            success: function(data) {
                console.log(data)
                $('#modalGelombang').text(data.gelombangPendaftaran);
                $('#feeId').text(formatRupiahJS(data.fee_id));
                $('#modalBiayaDaftar').text(formatRupiahJS(data.biaya_daftar));
            },
            error: function(error) {
                console.log("Terjadi kesalahan: ", error);
            }
        });
    });
});
JS;
$this->registerJs($js);
?>

<div class="card">
    <div class="card-body">
        <table id="datatables" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gelombang Pendaftaran</th>
                    <th>Fee</th>
                    <th>Biaya Daftar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= Html::encode($model->gelombang->desc) ?></td>
                        <td><?= $model->fincTFee ? Html::encode(\app\components\RupiahFormatter::format($model->fincTFee->amount)) : '-' ?></td>
                        <td><?= Html::encode(\app\components\RupiahFormatter::format($model->biaya_daftar)) ?></td>
                        <td>
                            <?= Html::button('<i class="fa fa-eye"></i>', ['class' => 'btn btn-primary btn-sm view-button', 'title' => 'View', 'data-toggle' => 'modal', 'data-target' => '#viewModal', 'data-id' => $model->biaya_pendaftaran_id]) ?>
                            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'biaya_pendaftaran_id' => $model->biaya_pendaftaran_id], ['class' => 'btn btn-info btn-sm', 'title' => 'Update']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModal">Detail Biaya Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <th>Nama Gelombang</th>
                        <td>:</td>
                        <td id="modalGelombang"></td>
                    </tr>
                    <tr>
                        <th>Fee</th>
                        <td>:</td>
                        <td id="feeId"></td>
                    </tr>
                    <tr>
                        <th>Biaya Pendaftaran</th>
                        <td>:</td>
                        <td id="modalBiayaDaftar"></td>
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