<?php
// var_dump($pilihanJurusan);
// die();

use yii\helpers\Html;

?>
<?php if (isset($autoPrint) && $autoPrint) : ?>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <div class="pas-foto-container">
                                    <img class="profile-user-img img-fluid" src="<?= Html::encode($model->pas_foto) ?>" alt="User profile picture" style="border-radius: 4px; width: 210px; height: 230px;">
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <img src="image/itdel.jpeg" alt="Logo" class="logo">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="text-center">
                                            <h4>Institut Teknologi Del</h4>
                                            <h6>Kartu Tanda Peserta</h6>
                                            <h3><?= Html::encode($model->jalurPendaftaran->desc) ?></h3>
                                            <h4><?= Html::encode($model->gelombangPendaftaran->desc) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>NOMOR PESERTA</td>
                            <td>USM100101111</td>
                        </tr>
                        <tr>
                            <td>NAMA PESERTA</td>
                            <td><?= Html::encode($model->nama) ?></td>
                        </tr>
                        <tr>
                            <td>TANGGAL LAHIR</td>
                            <td><?= Html::encode($model->tanggal_lahir) ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td><?= Html::encode($model->nik) ?></td>
                        </tr>
                        <tr>
                            <td><b>PELAKSANAAN UJIAN</b></td>
                        </tr>
                        <tr>
                            <td>HARI/TANGGAL</td>
                            <td><?= Html::encode($model->gelombangPendaftaran->tanggal_ujian) ?></td>
                        </tr>
                        <tr>
                            <td>PUKUL</td>
                            <td><?= Html::encode($model->gelombangPendaftaran->jam_mulai) ?></td>
                        </tr>
                        <tr>
                            <td>LOKASI</td>
                            <td><?= Html::encode($model->lokasi->alamat) ?></td>
                        </tr>
                        <tr>
                            <td>ALAMAT</td>
                            <td><?= Html::encode($model->lokasi->desc) ?></td>
                        </tr>
                        <tr>
                            <td><b>PILIHAN PRODI</b></td>
                        </tr>
                        <tr>
                            <td>PILIHAN 1</td>
                            <td><?= $pilihan1 ? Html::encode($pilihan1->jurusan->nama) : ' - ' ?></td>
                        </tr>
                        <tr>
                            <td>PILIHAN 2</td>
                            <td><?= $pilihan2 ? Html::encode($pilihan2->jurusan->nama) : ' - ' ?></td>
                        </tr>
                        <tr>
                            <td>PILIHAN 3</td>
                            <td><?= $pilihan3 ? Html::encode($pilihan3->jurusan->nama) : ' - ' ?>
                        </tr>
                        <tr>
                            <td><b>INFO PENTING</b></td>
                        </tr>
                        <tr>
                            <td colspan="2"> <!-- Menggabungkan dua kolom menjadi satu -->
                                <ol>
                                    <li>Membawa Kartu Tanda Peserta</li>
                                    <li>Membawa Kartu Tanda Penduduk / Kartu Pelajara</li>
                                    <li>Membawa Alat Tulis lika Onsite</li>
                                    <li>Menyediakan Laptop / PC dan akses Internet Jika Online</li>
                                    <li>Pastikan Lokasi Ujian Anda Benar</li>
                                    <li>Peserta Harus Dalam Kondisi Sehat</li>
                                </ol>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</body>

<style>
    .text-center h4,
    .text-center h6,
    .text-center h3 {
        margin-bottom: 5px;
        /* Contoh margin, sesuaikan sesuai kebutuhan */
    }

    /* Gaya khusus untuk saat mencetak */
    @media print {

        /* Sembunyikan header dan footer */
        header,
        .header,
        footer,
        .footer {
            display: none !important;
        }

        /* Sembunyikan elemen lain yang tidak ingin dicetak */
        .sidebar,
        .navbar,
        .non-printable {
            display: none !important;
        }

        /* Pastikan hanya konten yang ditampilkan */
        .content-wrapper,
        .printable {
            width: 100%;
            margin: 0;
        }
    }

    .item-column {
        width: 30%;
        /* Atur lebar sesuai kebutuhan */
    }

    .description-column {
        width: 70%;
        /* Atur lebar sesuai kebutuhan */
    }

    /* Gaya untuk tampilan di layar */
    .logo {
        width: 100px;
        /* Atur lebar logo */
        height: auto;
        /* Tinggi otomatis untuk menjaga rasio aspek */
        display: block;
        /* Pastikan logo ditampilkan sebagai blok */
        margin: 0 auto 10px;
        /* Taruh logo di tengah dengan margin bawah */
    }

    pas-foto-container {
        width: 100%;
        /* Atur lebar container sesuai kebutuhan */
        height: auto;
        /* Tinggi container akan menyesuaikan secara otomatis */
        display: flex;
        /* Gunakan flexbox untuk penempatan gambar */
        justify-content: center;
        /* Pusatkan gambar secara horizontal */
        align-items: center;
        /* Pusatkan gambar secara vertikal */
    }

    .pas-foto-container img {
        width: 50%;
        /* Buat gambar memenuhi lebar container */
        height: auto;
        /* Tinggi gambar akan menyesuaikan secara otomatis */
        object-fit: cover;
        /* Gambar akan ditutupi secara proporsional */
    }
</style>