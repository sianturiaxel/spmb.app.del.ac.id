<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\CalonMahasiswa $model */

$this->title = 'Calon Mahasiswa Detail';
$this->params['breadcrumbs'][] = ['label' => 'Calon Mahasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid" src="<?= Html::encode($model->pas_foto) ?>" alt="User profile picture" style="border-radius: 4px; width: 210px; height: 230px;">
                        </div>
                        <h3 class="profile-username text-center"><?= Html::encode($model->nama) ?> </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#data-pendaftar-ulang" data-toggle="tab">Data Pendaftar Ulang</a></li>
                            <li class="nav-item"><a class="nav-link" href="#data-diri" data-toggle="tab">Data Diri</a></li>
                            <li class="nav-item"><a class="nav-link" href="#data-orangtua" data-toggle="tab">Data OrangTua</a></li>
                            <li class="nav-item"><a class="nav-link" href="#data-wali" data-toggle="tab">Data Wali</a></li>
                            <li class="nav-item"><a class="nav-link" href="#data-akademis" data-toggle="tab">Data Akademis</a></li>
                            <li class="nav-item"><a class="nav-link" href="#data-lain" data-toggle="tab">Data Lain</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="data-pendaftar-ulang">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Total Pembayaran</b></td>
                                            <td>:</td>
                                            <td>Rp <?= Html::encode(number_format($model->total_pembayaran, 0, ',', '.')) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Pilihan Program Studi</b></td>
                                            <td>:</td>
                                            <td><?= Html::encode($model->jurusan->nama) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Uang Pengembangan</b></td>
                                            <td>:</td>
                                            <td><?= Html::encode($model->n) ?></td>
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
                                                    <td><?= Yii::$app->formatter->asDate($model->tanggal_lahir, 'long') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Jumlah Tanggungan OrangTua</b></td>
                                                    <td>:</td>
                                                    <td><?= !empty($model->jumlah_tanggungan_ortu) ? Html::encode($model->jumlah_tanggungan_ortu) : '-' ?></td>
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
                                                <tr>
                                                    <td><b>Alamat</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->alamat) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Kecamatan</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->kecamatan && $model->kecamatan->nama ? $model->kecamatan->nama : '-') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Golongan Darah</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->golonganDarah && $model->golonganDarah->desc ? $model->golonganDarah->desc : '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>NIK</b></td>
                                                    <td>:</td>
                                                    <td><?= !empty($model->nik) ? Html::encode($model->nik) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Nisn</b></td>
                                                    <td>:</td>
                                                    <td><?= !empty($model->nisn) ? Html::encode($model->nisn) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Anak Ke-</b></td>
                                                    <td>:</td>
                                                    <td><?= !empty($model->anak_ke) ? Html::encode($model->anak_ke) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Jumlah Bersaudara</b></td>
                                                    <td>:</td>
                                                    <td><?= !empty($model->jumlah_bersaudara) ? Html::encode($model->jumlah_bersaudara) : '-' ?></td>
                                                </tr>
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
                                                    <td><b>Kabupaten</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->kabupaten && $model->kabupaten->nama ? $model->kabupaten->nama : '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Provinsi</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->provinsi && $model->provinsi->nama ? $model->provinsi->nama : '-') ?></td>
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
                                                    <td><b>Nama Ibu</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->nama_ibu_kandung) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Ayah</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->pekerjaanAyah && $model->pekerjaanAyah->nama ? $model->pekerjaanAyah->nama : '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Ibu</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->pekerjaanIbu && $model->pekerjaanIbu->nama ? $model->pekerjaanIbu->nama : '-') ?></td>
                                                </tr>

                                                <tr>
                                                    <td><b>Alamat</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->alamat_orang_tua) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Kecamatan</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->kecamatanOrangtua && $model->kecamatanOrangtua->nama ? $model->kecamatanOrangtua->nama : '-') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Penghasilan Ayah</b></td>
                                                    <td>:</td>
                                                    <td>Rp <?= Html::encode(number_format($model->penghasilan_ayah, 0, ',', '.')) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Penghasilan Ibu</b></td>
                                                    <td>:</td>
                                                    <td>Rp <?= Html::encode(number_format($model->penghasilan_ibu, 0, ',', '.')) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Penghasilan Total</b></td>
                                                    <td>:</td>
                                                    <td>Rp <?= Html::encode(number_format($model->penghasilan_total, 0, ',', '.')) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>No Hp OrangTua</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->no_hp_orangtua) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Kabupaten</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->kabupatenOrangtua && $model->kabupatenOrangtua->nama ? $model->kabupatenOrangtua->nama : '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Provinsi</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->provinsiOrangtua && $model->provinsiOrangtua->nama ? $model->provinsiOrangtua->nama : '-') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="data-wali">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Nama Wali</b></td>
                                                    <td>:</td>
                                                    <td><?= !empty($model->nama_wali) ? Html::encode($model->nama_wali) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Nik Wali</b></td>
                                                    <td>:</td>
                                                    <td><?= !empty($model->nik_wali) ? Html::encode($model->nik_wali) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>No Hp Wali</b></td>
                                                    <td>:</td>
                                                    <td><?= !empty($model->no_hp_wali) ? Html::encode($model->no_hp_wali) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pekerjaan Wali</b></td>
                                                    <td>:</td>
                                                    <td><?= Html::encode($model->pekerjaanWali && $model->pekerjaanWali->nama ? $model->pekerjaanWali->nama : '-') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Penghasilan Wali</b></td>
                                                    <td>:</td>
                                                    <td>Rp <?= $model->penghasilan_wali > 0 ? Html::encode(number_format($model->penghasilan_wali, 0, ',', '.')) : '-' ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Alamat Wali</b></td>
                                                    <td>:</td>
                                                    <td><?= !empty($model->alamat_wali) ? Html::encode($model->alamat_wali) : '-' ?></td>
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
                                            <td><?= (isset($model->sekolahDapodik) && !empty($model->sekolahDapodik->sekolah)) ? Html::encode($model->sekolahDapodik->sekolah) : ' - ' ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Akreditasi Sekolah</b></td>
                                            <td>:</td>
                                            <td><?= !empty($model->akreditasi_sekolah) ? Html::encode($model->akreditasi_sekolah) : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat</b></td>
                                            <td>:</td>
                                            <td><?= (isset($model->sekolahDapodik) && !empty($model->sekolahDapodik->alamat_jalan)) ? Html::encode($model->sekolahDapodik->alamat_jalan) : ' - ' ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="data-lain">
                                <table class="table">
                                    <tbody>

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