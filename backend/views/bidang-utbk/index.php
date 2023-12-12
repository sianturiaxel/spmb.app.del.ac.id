<?php

use backend\models\BidangUtbk;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\BidangUtbkSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Penilaian Bidang UTBK';
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
        $('div.toolbar').html('<a href=\"{$createUrl}\" class=\"btn btn-success\">Tambah Penilaian Bidang UTBK</a>');
    });

    $(document).on('click', '.view-button', function() {
        var biayaPendaftaranId = $(this).data('id');
        $.ajax({
            url: '$view', // Sesuaikan URL
            type: 'GET',
            data: { biaya_pendaftaran_id: biayaPendaftaranId },
            success: function(data) {
                // Ambil data dari response dan tampilkan di modal
                $('#modalGelombang').text(data.gelombang);
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
                    <th>Kategori Biang UTBK</th>
                    <th>Jenis Ujian</th>
                    <th>Kode Ujian</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= Html::encode($model->kategori_bidang_utbk_id) ?></td>
                        <td><?= Html::encode($model->name) ?></td>

                        <td>
                            <?= Html::a('<i class="fa fa-eye"></i>', ['view', 'bidang_utbk_id' => $model->bidang_utbk_id], ['class' => 'btn btn-primary btn-sm', 'title' => 'View']) ?>
                            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'bidang_utbk_id' => $model->bidang_utbk_id], ['class' => 'btn btn-info btn-sm', 'title' => 'Update']) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'bidang_utbk_id' => $model->bidang_utbk_id], [
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>