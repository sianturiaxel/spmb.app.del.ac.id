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
                    <th>Aksi</th> <!-- Tambahkan header untuk kolom aksi -->
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($jurusanMapelData as $jurusanId => $data) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= Html::encode($data['nama']) ?></td>
                        <td><?= Html::encode(implode(', ', $data['mapel'])) ?></td>
                        <td>
                            <?= Html::a('Edit', ['update', 'jurusan_mapel_id' => $jurusanId], ['class' => 'btn btn-primary btn-sm']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>