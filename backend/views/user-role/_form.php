<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UserRole $model */
/** @var yii\widgets\ActiveForm $form */
$js = <<<JS
$(document).ready(function() {
    

    $(".select2").select2({
        
        width: '100%' // Atur lebar Select2
        
    });

  
   
});
JS;
$this->registerJs($js);
?>

<div class="role-form container mt-5">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" for="user-select">User</label>
                    <select class="form-control select2" id="user-select" name="UserRole[user_id]">
                        <option value="">Pilih User</option>
                        <?php foreach ($user as $u) : ?>
                            <option value="<?= Html::encode($u['id']); ?>" <?= $model->user_id == $u['id'] ? 'selected' : '' ?>>
                                <?= Html::encode($u['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" for="role-select">Role</label>
                    <select class="form-control select2" id="role-select" name="UserRole[role_id]">
                        <option value="">Pilih Role</option>
                        <?php foreach ($role as $r) : ?>
                            <option value="<?= Html::encode($r['id']); ?>" <?= $model->role_id == $r['id'] ? 'selected' : '' ?>>
                                <?= Html::encode($r['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div><br>
            <div class="card-footer">
                <div class="form-group">
                    <?= Html::button('Kembali', ['class' => 'btn btn-warning', 'onclick' => 'history.go(-1)']) ?>

                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
                </div>

            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>


<style>
    .select2-container--default .select2-selection--single {
        height: auto;
        /* Atau nilai lain yang sesuai dengan form lain */
    }
</style>