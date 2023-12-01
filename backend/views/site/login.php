<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \backend\models\Users $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Login';
?>

<body class="hold-transition login-page" style="display: flex; justify-content: center; align-items: center;">
    <div class="login-box">
        <div class="card-header text-center">
            <a class="h3" style="text-align:center;"><b>SPMB IT DEL</b></a>
        </div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="image/itdel.jpeg" alt="Your Logo" style="width: 100px; height: 100px; display: block; margin: 0 auto;" />
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => Url::to(['/site/login'])]); ?>
                <div class="input-group mb-3">
                    <?= Html::textInput('LoginForm[username]', null, ['class' => 'form-control', 'placeholder' => 'Username']) ?>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <?= Html::passwordInput('LoginForm[password]', null, ['class' => 'form-control', 'placeholder' => 'Password']) ?>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block']) ?>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-block btn-primary">Lupa Password</button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</body>