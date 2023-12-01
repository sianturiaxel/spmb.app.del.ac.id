<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \backend\models\Users $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Lupa Password';
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
                <p class="login-box-msg">Anda lupa kata sandi Anda? Di sini Anda dapat dengan mudah mengambil kata sandi baru.</p>
                <form action="recover-password.html" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="site/login">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>