<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Pendaftar $model */
$kartuUjian = Url::to(['pendaftar/download-kartu']);
$pilihanJurusan             = Url::to(['pendaftar/get-pilihan-jurusan']);
//$this->title = $model->pendaftar_id;
// $this->params['breadcrumbs'][] = ['label' => 'Pendaftars', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
$script = <<< JS
$(document).ready(function() {
    var pendaftarId = $model->pendaftar_id; 
    $.ajax({
        url: '$pilihanJurusan', // Menggunakan helper Url untuk menghasilkan URL yang benar
        type: 'GET',
        dataType: 'json',
        data: { pendaftar_id: pendaftarId },
        success: function(response) {
            if(response.pilihanJurusan && response.pilihanJurusan.length > 0) {
                var jurusanHtml = '';
                response.pilihanJurusan.forEach(function(pilihan) {
                    jurusanHtml += '<li>' + pilihan.namaJurusan;
                });
                $('#pilihan-jurusan').html(jurusanHtml); // Menampilkan semua jurusan
            } else {
                $('#pilihan-jurusan').text('Tidak ada pilihan jurusan.'); // Menampilkan pesan jika tidak ada jurusan
            }
        },
        error: function(xhr, status, error) {
            console.error("Terjadi kesalahan: " + error);
        }
    });

    
});
JS;
$this->registerJs($script);

?>


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
                        <div class="text-center">
                            <a href="<?= Url::to(['pendaftar/download-kartu', 'pendaftar_id' => $model->pendaftar_id]) ?>" class="btn btn-warning" target="_blank">Download Kartu Ujian</a>
                        </div>
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
                                            <td><?= Html::encode($model->lokasi->alamat) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Pilihan Program Studi</b></td>
                                            <td>:</td>
                                            <td id="pilihan-jurusan"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Jumlah N</b></td>
                                            <td>:</td>
                                            <td><?= Html::encode($model->n) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Status Pembayaran</b></td>
                                            <td>:</td>
                                            <td><?= Html::encode($model->statusPendaftaran->desc) ?></td>
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
                                                    <td><?= Html::encode($model->nama_ayah_kandung) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Ayah</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->pekerjaanAyah->nama) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Penghasilan Ayah</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->penghasilan_ayah) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Alamat</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->alamat_orang_tua) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>No Hp OrangTua</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->no_hp_orangtua) ?></td>
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
                                                    <td><?= Html::encode($model->nama_ibu_kandung) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Ibu</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->pekerjaanIbu->nama) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Penghasilan Ibu</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->penghasilan_ibu) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="data-akademis">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Jurusan</b></td>
                                            <td>:</td>
                                            <td><?= Html::encode($model->jurusan_sekolah) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Asal Sekolah</b></td>
                                            <td>:</td>
                                            <td><?= Html::encode($model->sekolah->nama) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat</b></td>
                                            <td>:</td>
                                            <td><?= Html::encode($model->sekolah->alamat) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="data-lain">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Hobby</b></td>
                                            <td>:</td>
                                            <td><?= Html::encode($model->hobby) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Motivasi</b></td>
                                            <td>:</td>
                                            <td style="text-align: justify;"><?= Html::encode($model->motivasi) ?></td>
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