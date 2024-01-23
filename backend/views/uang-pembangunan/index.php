<?php

use backend\models\UangPembangunan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UangPembangunanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Uang Pembangunan';
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
        $('div.toolbar').html('<a href=\"{$createUrl}\" class=\"btn btn-success\">Tambah Uang Pembangunan</a>');
    });
});

function formatRupiahJS(angka) {
        return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

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
                    <th>Jurusan</th>
                    <th>Minumum 'N'</th>
                    <th>Base 'N'</th>
                    <th>Multi 'N'</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td> <?= $model->gelombangPendaftaran ? Html::encode($model->gelombangPendaftaran->desc) : 'Data tidak tersedia' ?></td>
                        <td> <?= $model->jurusan ? Html::encode($model->jurusan->nama) : 'Data tidak tersedia' ?></td>
                        <td><?= Html::encode($model->minimum_n) ?></td>
                        <td><?= Html::encode($model->base_n) ?></td>
                        <td><?= Html::encode(\app\components\RupiahFormatter::format($model->multi_n)) ?></td>

                        <td>
                            <?= Html::a('<i class="fa fa-eye"></i>', ['view', 'uang_pembangunan_id' => $model->uang_pembangunan_id], ['class' => 'btn btn-primary btn-sm', 'title' => 'View']) ?>
                            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'uang_pembangunan_id' => $model->uang_pembangunan_id], ['class' => 'btn btn-info btn-sm', 'title' => 'Update']) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'uang_pembangunan_id' => $model->uang_pembangunan_id], [
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