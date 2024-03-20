<?php

use yii\helpers\Url;
use backend\components\RbacHelper;

$js = <<< JS
$(document).ready(function() {
    var activeController = '{$this->context->id}'; 
    if (['kode-ujian','sekolah-pmdk','jurusan-mapel','bidang-utbk','waktu-pengumuman','uang-pembangunan','biaya-pendaftaran','lokasi-ujian','uang-daftar-ulang','gelombang-pendaftaran', 'users','role','user-role',
        'nilai-wawancara','nilai-psikotes','nilai-akademik','calon-mahasiswa', 'berkas-daftar-ulang', 'payment-detail', 'penangguhan-daftar-ulang','pendaftar'].includes(activeController)) {
        $(".nav-link.active").closest('.nav-treeview').parent().addClass('menu-open');
    }
});
JS;
$this->registerJs($js);
$isAdmin = Yii::$app->user->identity->roles[0]->name;
// var_dump($isAdmin);
// die()
// 
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="image/itdel.jpeg" class="rounded elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block custom-text">SPMB IT DEL</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item <?= Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index' ? 'menu-open' : '' ?>">
                    <a href="<?= Url::to(['site/index']) ?>" class="nav-link <?= Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <?php if (RbacHelper::isUserAdmin(Yii::$app->user->id) || RbacHelper::isUserPanitia(Yii::$app->user->id)) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link  <?= in_array(Yii::$app->controller->id, ['gelombang-pendaftaran', 'sekolah-pmdk', 'lokasi-ujian', 'kode-ujian', 'sekolah-pmdk', 'jurusan-mapel', 'bidang-pmdk', 'waktu-pengumuman', 'uang-pembangunan', 'biaya-pendaftaran', 'uang-daftar-ulang']) ? 'active menu-open' : '' ?>">

                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Administrasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul id="submenu-administrasi" class="nav nav-treeview" style="margin-left: 20px;">
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-people-arrows nav-icon"></i><p>Gel Pendaftaran</p>',
                                    ['gelombang-pendaftaran/index'],
                                    ['class' => Yii::$app->controller->id == 'gelombang-pendaftaran' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>

                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-barcode nav-icon"></i><p>Kode Ujian</p>',
                                    ['kode-ujian/index'],
                                    ['class' => Yii::$app->controller->id == 'kode-ujian' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-university nav-icon"></i><p>Sekolah PMDK</p>',
                                    ['sekolah-pmdk/index'],
                                    ['class' => Yii::$app->controller->id == 'sekolah-pmdk' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-random nav-icon"></i><p>Mapel Jurusan</p>',
                                    ['jurusan-mapel/index'],
                                    ['class' => Yii::$app->controller->id == 'jurusan-mapel' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-th-list nav-icon"></i><p>Bidang Penilaian UTBK</p>',
                                    ['bidang-utbk/index'],
                                    ['class' => Yii::$app->controller->id == 'bidang-utbk' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="far fa-calendar-alt nav-icon"></i><p>Waktu Pengumuman</p>',
                                    ['waktu-pengumuman/index'],
                                    ['class' => Yii::$app->controller->id == 'waktu-pengumuman' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-money-check nav-icon"></i><p>Uang Pembangunan</p>',
                                    ['uang-pembangunan/index'],
                                    ['class' => Yii::$app->controller->id == 'uang-pembangunan' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-money-bill-alt nav-icon"></i><p>Biaya Pendaftaran</p>',
                                    ['biaya-pendaftaran/index'],
                                    ['class' => Yii::$app->controller->id == 'biaya-pendaftaran' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-money-bill-wave nav-icon"></i><p>Uang Daftar Ulang</p>',
                                    ['uang-daftar-ulang/index'],
                                    ['class' => Yii::$app->controller->id == 'uang-daftar-ulang' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (RbacHelper::isUserAdmin(Yii::$app->user->id) || RbacHelper::isUserPanitia(Yii::$app->user->id)) : ?>
                    <li class="nav-item <?= in_array(Yii::$app->controller->id, ['kecamatan', 'kabupaten', 'provinsi', 'jenjang-pendidikan', 'pekerjaan', 'golongan-darah', 'voucher', 'jenis-ujian', 'status-pendaftaran', 'metode-pembayaran', 'jurusan-sekolah', 'fakultas', 'agama', 'jurusan']) ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= in_array(Yii::$app->controller->id, ['kecamatan', 'kabupaten', 'provinsi']) ? 'active menu-open' : '' ?>">
                            <i class="nav-icon fa fa-folder-open"></i>
                            <p>
                                Data Refrensi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="margin-left: 20px;">
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-map-marker-alt nav-icon"></i><p>Kecamatan</p>',
                                    ['kecamatan/index'],
                                    ['class' => Yii::$app->controller->id == 'kecamatan' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-map-marker-alt nav-icon"></i><p>Kabupaten</p>',
                                    ['kabupaten/index'],
                                    ['class' => Yii::$app->controller->id == 'kabupaten' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-map-marker-alt nav-icon"></i><p>Provinsi</p>',
                                    ['provinsi/index'],
                                    ['class' => Yii::$app->controller->id == 'provinsi' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="pages/mailbox/mailbox.html" class="nav-link">
                                    <i class="fas fa-id-card-alt nav-icon"></i>
                                    <p>Kewarganegaraan</p>
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-book nav-icon"></i><p>Pendidikan</p>',
                                    ['jenjang-pendidikan/index'],
                                    ['class' => Yii::$app->controller->id == 'jenjang-pendidikan' ? 'nav-link active' : 'nav-link']
                                ) ?>

                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-user-tie nav-icon"></i><p>Pekerjaan</p>',
                                    ['pekerjaan/index'],
                                    ['class' => Yii::$app->controller->id == 'pekerjaan' ? 'nav-link active' : 'nav-link']
                                ) ?>

                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-book-reader nav-icon"></i><p>Jurusan Sekolah</p>',
                                    ['jurusan-sekolah/index'],
                                    ['class' => Yii::$app->controller->id == 'jurusan-sekolah' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <a href="pages/mailbox/mailbox.html" class="nav-link">
                                    <i class="fas fa-university nav-icon"></i>
                                    <p>Sekolah Dapodik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/mailbox/mailbox.html" class="nav-link">
                                    <i class="fas fa-flask nav-icon"></i>
                                    <p>Mata Pelajaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="	fas fa-search-location nav-icon"></i><p>Lokasi Ujian</p>',
                                    ['lokasi-ujian/index'],
                                    ['class' => Yii::$app->controller->id == 'lokasi-ujian' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-pen-nib nav-icon"></i><p>Jenis Ujian</p>',
                                    ['jenis-ujian/index'],
                                    ['class' => Yii::$app->controller->id == 'jenis-ujian' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-percent nav-icon"></i><p>Vocher</p>',
                                    ['voucher/index'],
                                    ['class' => Yii::$app->controller->id == 'voucher' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-tint nav-icon"></i><p>Golongan Darah</p>',
                                    ['golongan-darah/index'],
                                    ['class' => Yii::$app->controller->id == 'golongan-darah' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-tags nav-icon"></i><p>Metode Pembayaran</p>',
                                    ['metode-pembayaran/index'],
                                    ['class' => Yii::$app->controller->id == 'metode-pembayaran' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-clipboard-check nav-icon"></i><p>Status Pendaftaran</p>',
                                    ['status-pendaftaran/index'],
                                    ['class' => Yii::$app->controller->id == 'status-pendaftaran' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-university nav-icon"></i><p>Fakultas</p>',
                                    ['fakultas/index'],
                                    ['class' => Yii::$app->controller->id == 'fakultas' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-handshake nav-icon"></i><p>Jurusan</p>',
                                    ['jurusan/index'],
                                    ['class' => Yii::$app->controller->id == 'jurusan' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-praying-hands nav-icon"></i><p>Agama</p>',
                                    ['agama/index'],
                                    ['class' => Yii::$app->controller->id == 'agama' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (RbacHelper::isUserAdmin(Yii::$app->user->id) || RbacHelper::isUserPanitia(Yii::$app->user->id) || RbacHelper::isUserKaprodi(Yii::$app->user->id)) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link <?= in_array(Yii::$app->controller->id, ['pendaftar', 'pendaftar-offline']) ? 'active menu-open' : '' ?>>">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Pendaftar
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="margin-left: 20px;">
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-file-alt nav-icon"></i><p>Pendaftar</p>',
                                    ['pendaftar/index'],
                                    ['class' => Yii::$app->controller->id == 'pendaftar' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-file-alt nav-icon"></i><p>Pendaftar Offline</p>',
                                    ['pendaftar-offline/index'],
                                    ['class' => Yii::$app->controller->id == 'pendaftar-offline' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (RbacHelper::isUserAdmin(Yii::$app->user->id) || RbacHelper::isUserPanitia(Yii::$app->user->id) || RbacHelper::isUserKaprodi(Yii::$app->user->id)) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link <?= in_array(Yii::$app->controller->id, ['nilai-wawancara', 'nilai-akademik', 'nilai-psikotes']) ? 'active menu-open' : '' ?>>">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>
                                Nilai
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="margin-left: 20px;">
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fa fa-star nav-icon"></i><p>Nilai Wawancara</p>',
                                    ['nilai-wawancara/index'],
                                    ['class' => Yii::$app->controller->id == 'nilai-wawancara' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fa fa-star nav-icon"></i><p>Nilai Akademik</p>',
                                    ['nilai-akademik/index'],
                                    ['class' => Yii::$app->controller->id == 'nilai-akademik' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fa fa-star nav-icon"></i><p>Nilai Psikotes</p>',
                                    ['nilai-psikotes/index'],
                                    ['class' => Yii::$app->controller->id == 'nilai-psikotes' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (RbacHelper::isUserAdmin(Yii::$app->user->id) || RbacHelper::isUserPanitia(Yii::$app->user->id)) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-search-location"></i>
                            <p>
                                Pindah Lokasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="margin-left: 20px;">
                            <li class="nav-item">
                                <a href="pages/mailbox/mailbox.html" class="nav-link">
                                    <i class="fa fa-location-arrow nav-icon"></i>
                                    <p>List Pindah Lokasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (RbacHelper::isUserAdmin(Yii::$app->user->id) || RbacHelper::isUserPanitia(Yii::$app->user->id) || RbacHelper::isUserKaprodi(Yii::$app->user->id)) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link <?= in_array(Yii::$app->controller->id, ['calon-mahasiswa', 'berkas-daftar-ulang', 'payment-detail', 'penangguhan-daftar-ulang']) ? 'active menu-open' : '' ?>">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Calon Mahasiswa
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="margin-left: 20px;">
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-users nav-icon"></i><p>Pendaftar Ulang</p>',
                                    ['calon-mahasiswa/index'],
                                    ['class' => Yii::$app->controller->id == 'calon-mahasiswa' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="far fa-id-card nav-icon"></i><p>Berkas Daftar Ulang</p>',
                                    ['berkas-daftar-ulang/index'],
                                    ['class' => Yii::$app->controller->id == 'berkas-daftar-ulang' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-money-check nav-icon"></i><p>Payment Detail</p>',
                                    ['payment-detail/index'],
                                    ['class' => Yii::$app->controller->id == 'payment-detail' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (RbacHelper::isUserAdmin(Yii::$app->user->id)) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link  <?= in_array(Yii::$app->controller->id, ['users', 'role', 'user-role']) ? 'active menu-open' : '' ?>">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                User
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="margin-left: 20px;">
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-users nav-icon"></i><p>List User</p>',
                                    ['users/index'],
                                    ['class' => Yii::$app->controller->id == 'users' ? 'nav-link active' : 'nav-link']
                                ) ?>

                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-users nav-icon"></i><p>Role</p>',
                                    ['role/index'],
                                    ['class' => Yii::$app->controller->id == 'role' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-users nav-icon"></i><p>Assigment User Role</p>',
                                    ['user-role/index'],
                                    ['class' => Yii::$app->controller->id == 'user-role' ? 'nav-link active' : 'nav-link']
                                ) ?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


<style>
    /*Untuk menonaktifkan efek hover pada */
    sub-menu .nav-item:hover .nav-link {
        background-color: #f8f9fa;
        /* Warna latar belakang saat di-hover */
        color: #333;
        /* Warna teks saat di-hover */
        font-weight: normal;
        /* Berat huruf saat di-hover */
    }

    /* Untuk memberikan efek hover pada menu utama */
    .nav-item:hover>.nav-link {
        background-color: #007bff;
        /* Warna latar belakang saat di-hover */
        color: #fff;
        /* Warna teks saat di-hover */
        font-weight: bold;
        /* Berat huruf saat di-hover */
    }

    /* Untuk memberikan efek hover pada sub-menu aktif */
    .nav-item.active .nav-link:hover {
        background-color: #007bff;
        /* Warna latar belakang saat di-hover */
        color: #fff;
        /* Warna teks saat di-hover */
        font-weight: bold;
        /* Berat huruf saat di-hover */
    }

    .custom-text {
        font-size: 18px;
        /* Contoh ukuran font, sesuaikan sesuai kebutuhan */
        font-weight: bold;
        margin-left: 20px;
        color: white;
        /* Contoh margin ke kanan, sesuaikan sesuai kebutuhan */
    }
</style>