<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\CalonMahasiswa $model */

$this->title = $model->calon_mahasiswa_id;
$this->params['breadcrumbs'][] = ['label' => 'Calon Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="calon-mahasiswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'calon_mahasiswa_id' => $model->calon_mahasiswa_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'calon_mahasiswa_id' => $model->calon_mahasiswa_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'calon_mahasiswa_id',
            'pendaftar_id',
            'jalur_pendaftaran_id',
            'cis_imported',
            'jurusan_id',
            'user_id',
            'nik',
            'nisn',
            'no_kps',
            'nama',
            'jenis_kelamin_id',
            'golongan_darah_id',
            'tanggal_lahir',
            'tempat_lahir',
            'agama_id',
            'anak_ke',
            'jumlah_bersaudara',
            'jumlah_tanggungan_ortu',
            'alamat:ntext',
            'kode_pos',
            'kelurahan',
            'alamat_kec',
            'alamat_kab',
            'alamat_prov',
            'kewarganegaraan_id',
            'no_telepon_rumah',
            'no_telepon_mobile',
            'email:email',
            'nama_ayah_kandung',
            'nama_ibu_kandung',
            'nik_ayah',
            'nik_ibu',
            'tanggal_lahir_ayah',
            'tanggal_lahir_ibu',
            'pendidikan_ayah_id',
            'pendidikan_ibu_id',
            'alamat_orang_tua:ntext',
            'kode_pos_orang_tua',
            'alamat_kec_orangtua',
            'alamat_kab_orangtua',
            'alamat_prov_orangtua',
            'pekerjaan_ayah_id',
            'pekerjaan_ibu_id',
            'penghasilan_ayah_id',
            'penghasilan_ibu_id',
            'penghasilan_ayah',
            'penghasilan_ibu',
            'penghasilan_total',
            'no_telepon_mobile_ayah',
            'no_telepon_mobile_ibu',
            'nama_wali',
            'nik_wali',
            'no_hp_wali',
            'pekerjaan_wali_id',
            'penghasilan_wali',
            'alamat_wali',
            'sekolah_id',
            'jurusan_sekolah',
            'akreditasi_sekolah',
            'npwp',
            'kebutuhan_khusus_mahasiswa',
            'informasi_del_id',
            'informasi_del_lainnya:ntext',
            'n',
            'nim',
            'tanggal_pendaftaran',
            'status_pembayaran',
            'total_pembayaran',
            'virtual_account_number',
            'bank_name',
            'pas_foto',
            'berkas_pendaftaran_ulang',
            'jurusan_sekolah_id',
            'sekolah_dapodik_id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            't_payment_detail',
        ],
    ]) ?>

</div>
