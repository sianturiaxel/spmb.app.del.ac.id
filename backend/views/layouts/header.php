<?php

use yii\helpers\Html;

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-avatar" style="background-image: url('');">
                    <!-- Placeholder untuk avatar jika Anda memiliki gambar -->
                </div>
                <div class="user-icon ms-2">
                    <i class="fas fa-user-alt fa-2x"></i>
                </div>
                <div class="user-info ms-2">
                    <div class="nama"><?= Yii::$app->user->identity->nama ?></div>
                    <div class="user-role text-muted"><?= Yii::$app->user->identity->roles[0]->name ?></div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 300px; padding: 15px;">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="text-center"> <!-- Membuat konten berada di tengah -->
                        <img src="adminLTE/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-80 img-circle mb-2"> <!-- Menggunakan mb-2 untuk memberikan jarak ke bawah -->
                        <h3 class="dropdown-item-title">
                            <?= Yii::$app->user->identity->nama ?>
                            <span class="text-sm text-danger"><i></i></span>
                        </h3>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="row">
                    <div class="col-md-6">
                        <?= Html::a('Profil', ['/site/profil'], [
                            'data' => ['method' => 'post'],
                            'class' => 'btn btn-block btn-warning'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::a('Logout', ['/site/logout'], [
                            'data' => ['method' => 'post'],
                            'class' => 'btn btn-block btn-danger'
                        ]) ?>
                    </div>
                </div>

            </div>

        </li>
        <!-- Notifications Dropdown Menu -->
    </ul>
</nav>


<style>
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-size: cover;
        background-position: center left;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .username {
        font-weight: bold;
    }

    .user-role {
        font-size: 0.8em;
    }
</style>