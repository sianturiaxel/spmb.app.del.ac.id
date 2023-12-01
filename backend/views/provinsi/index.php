<?php

use backend\models\Provinsi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ProvinsiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Provinsi';
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
        $('div.toolbar').html('<a href=\"{$createUrl}\" class=\"btn btn-success\">Tambah Data Provinsi</a>');
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
                    <th>Kode Provinsi</th>
                    <th>Nama Provinsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= Html::encode($model->provinsi_id) ?></td>
                        <td><?= Html::encode($model->nama) ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-eye"></i>', ['view', 'provinsi_id' => $model->provinsi_id], ['class' => 'btn btn-primary btn-sm', 'title' => 'View']) ?>
                            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'provinsi_id' => $model->provinsi_id], ['class' => 'btn btn-info btn-sm', 'title' => 'Update']) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'provinsi_id' => $model->provinsi_id], [
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