<?php

use backend\models\JurusanMapel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\JurusanMapelSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mapel Jurusan';
$dataProvider->pagination = false;
$createUrl = Url::to(['create']);
$js = <<<JS
$(document).ready(function() {
    $('#datatables').DataTable({
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
    $('div.toolbar').html('<a href="$createUrl" class="btn btn-success">Tambah Mapel Jurusan</a>');
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
                    <th>Nama Jurusan</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td> <?= $model->jurusan ? Html::encode($model->jurusan->nama) : 'Data tidak tersedia' ?></td>
                        <td> <?= $model->mataPelajaran ? Html::encode($model->mataPelajaran->desc) : 'Data tidak tersedia' ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-eye"></i>', ['view', 'jurusan_mapel_id' => $model->jurusan_mapel_id], ['class' => 'btn btn-primary btn-sm', 'title' => 'View']) ?>
                            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'jurusan_mapel_id' => $model->jurusan_mapel_id], ['class' => 'btn btn-info btn-sm', 'title' => 'Update']) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'jurusan_mapel_id' => $model->jurusan_mapel_id], [
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