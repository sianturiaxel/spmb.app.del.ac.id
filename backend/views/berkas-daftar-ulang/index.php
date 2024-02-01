<?php

use backend\models\Provinsi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ProvinsiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Berkas Daftar Ulang';
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
        $('div.toolbar').html('<a href=\"{$createUrl}\" class=\"btn btn-success\">Tambah Berkas Daftar Ulang</a>');
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
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Berkas</th>
                    <th>Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model) : ?>
                    <tr>

                        <td><?= $index + 1 ?></td>
                        <td><?= Html::encode($model->name) ?></td>
                        <td><?= Html::encode($model->desc) ?></td>
                        <td><?= Html::encode($model->berkas) ?></td>
                        <td><?= Html::encode($model->link) ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-eye"></i>', ['view', 'berkas_daftar_ulang_id' => $model->berkas_daftar_ulang_id], ['class' => 'btn btn-primary btn-sm', 'title' => 'View']) ?>
                            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'berkas_daftar_ulang_id' => $model->berkas_daftar_ulang_id], ['class' => 'btn btn-info btn-sm', 'title' => 'Update']) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'berkas_daftar_ulang_id' => $model->berkas_daftar_ulang_id], [
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
    #datatables td:nth-child(1) {
        width: 10px;
    }

    #datatables td:nth-child(2) {
        width: 200px;
    }

    #datatables td:nth-child(3) {
        width: 200px;
    }

    #datatables td:nth-child(4) {
        /* Sesuaikan indeks sesuai dengan kolom 'Berkas' */
        max-width: 200px;
        /* Atau lebar maksimum yang diinginkan */
        min-width: 200px;
        /* Atau lebar minimum yang diinginkan */
    }

    #datatables td:nth-child(5) {
        /* Sesuaikan indeks sesuai dengan kolom 'Berkas' */
        max-width: 200px;
        /* Atau lebar maksimum yang diinginkan */
        min-width: 200px;
        /* Atau lebar minimum yang diinginkan */
    }

    #datatables td:nth-child(3) {
        width: 200px;
    }
</style>