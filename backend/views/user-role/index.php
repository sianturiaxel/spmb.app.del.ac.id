<?php

use backend\models\UserRole;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UserRoleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'User Roles';
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
        });
        $('div.toolbar').html('<a href=\"{$createUrl}\" class=\"btn btn-success\">Tambah User Role</a>');
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
                    <th>Nama User</th>
                    <th>Nama Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataProvider->getModels() as $index => $model) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= Html::encode($model->user->username) ?></td>
                        <td><?= Html::encode($model->role->name) ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-eye"></i>', ['view', 'user_id' => $model->user_id, 'role_id' => $model->role_id], ['class' => 'btn btn-primary btn-sm', 'title' => 'View']) ?>
                            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'user_id' => $model->user_id, 'role_id' => $model->role_id], ['class' => 'btn btn-info btn-sm', 'title' => 'Update']) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'user_id' => $model->user_id, 'role_id' => $model->role_id], [
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
    <!-- /.card-body -->
</div>