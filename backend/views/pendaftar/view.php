<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Pendaftar $model */

$this->title = $model->pendaftar_id;
$this->params['breadcrumbs'][] = ['label' => 'Pendaftars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid" src="image/foto.png" alt="User profile picture" style="border-radius: 4px; width: 210px; height: 230px;">
                        </div>
                        <h3 class="profile-username text-center"><?= Html::encode($model->nama) ?> </h3>
                        <a href="#" class="btn btn-primary btn-block"><b>Cetak Kartu</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#lokasi-ujian" data-toggle="tab">Lokasi Ujian</a></li>
                            <li class="nav-item"><a class="nav-link" href="#data-diri" data-toggle="tab">Data Diri</a></li>
                            <li class="nav-item"><a class="nav-link" href="#data-orangtua" data-toggle="tab">Data OrangTua</a></li>
                            <li class="nav-item"><a class="nav-link" href="#data-akademis" data-toggle="tab">Data Akademis</a></li>
                            <li class="nav-item"><a class="nav-link" href="#data-lain" data-toggle="tab">Data Lain</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="lokasi-ujian">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Lokasi Ujian</b></td>
                                            <td>:</td>
                                            <td>Data Lokasi Ujian dari Database</td>
                                        </tr>
                                        <tr>
                                            <td><b>Pilihan Program Studi</b></td>
                                            <td>:</td>
                                            <td>Data Program Studi dari Database</td>
                                        </tr>
                                        <tr>
                                            <td><b>Jumlah N</b></td>
                                            <td>:</td>
                                            <td>Data Jumlah N dari Database</td>
                                        </tr>
                                        <tr>
                                            <td><b>Status Pembayaran</b></td>
                                            <td>:</td>
                                            <td>Data Status Pembayaran dari Database</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="data-diri">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Nama Lengkap</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->nama) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Tempat Lahir</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->tempat_lahir) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Tanggal Lahir</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->tanggal_lahir) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Jenis Kelamin</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->jenisKelamin->desc) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Agama</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->agama->desc) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Alamat Email</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->email) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>No Telp.</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->no_telepon_rumah) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>No HP.</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->no_telepon_mobile) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Alamat</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->alamat) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="data-orangtua">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Nama Ayah</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->nama) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Ayah</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->tempat_lahir) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Penghasilan Ayah</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->tanggal_lahir) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Alamat</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->jenisKelamin->desc) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>No Hp OrangTua</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->agama->desc) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Nama Ibu</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->email) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Ibu</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->no_telepon_rumah) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Penghasilan Ibu</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->no_telepon_mobile) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="data-orangtua">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            10 Feb. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-info"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-success">
                                            3 Jan. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                            <div class="timeline-body">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="data-akademis">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Jurusan</b></td>
                                            <td>:</td>
                                            <td>Data Lokasi Ujian dari Database</td>
                                        </tr>
                                        <tr>
                                            <td><b>Asal Sekolah</b></td>
                                            <td>:</td>
                                            <td>Data Program Studi dari Database</td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat</b></td>
                                            <td>:</td>
                                            <td>Data Jumlah N dari Database</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="data-lain">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Motivasi</b></td>
                                            <td>:</td>
                                            <td>Data Lokasi Ujian dari Database</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>