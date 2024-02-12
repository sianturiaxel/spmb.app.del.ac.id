<?php

use backend\models\WaktuPengumuman;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\WaktuPengumumanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Waktu Pengumuman';
$dataProvider->pagination = false;
$createUrl = Url::to(['create']);
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
        $('div.toolbar').html('<a href=\"{$createUrl}\" class=\"btn btn-success\">Tambah Waktu Pengumuman</a>');
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
                    <th>Jenis Test</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                    <th>Catatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td> <?= $model->gelombangPendaftaran ? Html::encode($model->gelombangPendaftaran->desc) : 'Data tidak tersedia' ?></td>
                        <td> <?= $model->jenisTest ? Html::encode($model->jenisTest->nama) : 'Data tidak tersedia' ?></td>
                        <td><?= Html::encode($model->tanggal_mulai) ?></td>
                        <td><?= Html::encode($model->tanggal_akhir) ?></td>
                        <td><?= Html::encode($model->catatan) ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-eye"></i>', ['view', 'waktu_pengumuman_id' => $model->waktu_pengumuman_id], ['class' => 'btn btn-primary btn-sm', 'title' => 'View']) ?>
                            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'waktu_pengumuman_id' => $model->waktu_pengumuman_id], ['class' => 'btn btn-info btn-sm', 'title' => 'Update']) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'waktu_pengumuman_id' => $model->waktu_pengumuman_id], [
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


<style>
    #datatables td:nth-child(7) {
        /* Sesuaikan indeks sesuai dengan kolom 'Berkas' */
        max-width: 200px;
        /* Atau lebar maksimum yang diinginkan */
        min-width: 150px;
        /* Atau lebar minimum yang diinginkan */
    }
</style>