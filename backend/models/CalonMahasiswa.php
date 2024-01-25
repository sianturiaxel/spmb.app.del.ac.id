<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_calon_mahasiswa".
 *
 * @property int $calon_mahasiswa_id
 * @property int $pendaftar_id
 * @property int $jalur_pendaftaran_id
 * @property int $cis_imported
 * @property int $jurusan_id
 * @property int $user_id
 * @property string|null $nik
 * @property string|null $nisn
 * @property string|null $no_kps
 * @property string|null $nama
 * @property int $jenis_kelamin_id
 * @property int $golongan_darah_id
 * @property string|null $tanggal_lahir
 * @property string|null $tempat_lahir
 * @property int $agama_id
 * @property int|null $anak_ke
 * @property int|null $jumlah_bersaudara
 * @property int|null $jumlah_tanggungan_ortu
 * @property string|null $alamat
 * @property string|null $kode_pos
 * @property string|null $kelurahan
 * @property int|null $alamat_kec
 * @property int $alamat_kab
 * @property int $alamat_prov
 * @property int $kewarganegaraan_id
 * @property string|null $no_telepon_rumah
 * @property string|null $no_telepon_mobile
 * @property string|null $email
 * @property string|null $nama_ayah_kandung
 * @property string|null $nama_ibu_kandung
 * @property string|null $nik_ayah
 * @property string|null $nik_ibu
 * @property string|null $tanggal_lahir_ayah
 * @property string|null $tanggal_lahir_ibu
 * @property int|null $pendidikan_ayah_id
 * @property int|null $pendidikan_ibu_id
 * @property string|null $alamat_orang_tua
 * @property string|null $kode_pos_orang_tua
 * @property int $alamat_kec_orangtua
 * @property int $alamat_kab_orangtua
 * @property int $alamat_prov_orangtua
 * @property int $pekerjaan_ayah_id
 * @property int $pekerjaan_ibu_id
 * @property int $penghasilan_ayah_id
 * @property int $penghasilan_ibu_id
 * @property int|null $penghasilan_ayah
 * @property int|null $penghasilan_ibu
 * @property int|null $penghasilan_total
 * @property string|null $no_telepon_mobile_ayah
 * @property string|null $no_telepon_mobile_ibu
 * @property string|null $nama_wali
 * @property string $nik_wali
 * @property string|null $no_hp_wali
 * @property int|null $pekerjaan_wali_id
 * @property int|null $penghasilan_wali
 * @property int $alamat_wali
 * @property int $sekolah_id
 * @property string|null $jurusan_sekolah
 * @property string $akreditasi_sekolah
 * @property int $npwp
 * @property int $kebutuhan_khusus_mahasiswa
 * @property int $informasi_del_id
 * @property string|null $informasi_del_lainnya
 * @property int|null $n
 * @property string|null $nim
 * @property string $tanggal_pendaftaran
 * @property int|null $status_pembayaran
 * @property float|null $total_pembayaran
 * @property string|null $virtual_account_number
 * @property string $bank_name
 * @property string|null $pas_foto
 * @property string|null $berkas_pendaftaran_ulang
 * @property int|null $jurusan_sekolah_id
 * @property int|null $sekolah_dapodik_id
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int $t_payment_detail
 */
class CalonMahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_calon_mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['pendaftar_id', 'jalur_pendaftaran_id', 'cis_imported', 'jurusan_id', 'user_id', 'jenis_kelamin_id', 'golongan_darah_id', 'agama_id', 'alamat_kab', 'alamat_prov', 'kewarganegaraan_id', 'alamat_kec_orangtua', 'alamat_kab_orangtua', 'alamat_prov_orangtua', 'pekerjaan_ayah_id', 'pekerjaan_ibu_id', 'penghasilan_ayah_id', 'penghasilan_ibu_id', 'nik_wali', 'alamat_wali', 'sekolah_id', 'akreditasi_sekolah', 'npwp', 'kebutuhan_khusus_mahasiswa', 'informasi_del_id', 'tanggal_pendaftaran', 'bank_name', 't_payment_detail'], 'required'],
            // [['pendaftar_id', 'jalur_pendaftaran_id', 'cis_imported', 'jurusan_id', 'user_id', 'jenis_kelamin_id', 'golongan_darah_id', 'agama_id', 'anak_ke', 'jumlah_bersaudara', 'jumlah_tanggungan_ortu', 'alamat_kec', 'alamat_kab', 'alamat_prov', 'kewarganegaraan_id', 'pendidikan_ayah_id', 'pendidikan_ibu_id', 'alamat_kec_orangtua', 'alamat_kab_orangtua', 'alamat_prov_orangtua', 'pekerjaan_ayah_id', 'pekerjaan_ibu_id', 'penghasilan_ayah_id', 'penghasilan_ibu_id', 'penghasilan_ayah', 'penghasilan_ibu', 'penghasilan_total', 'pekerjaan_wali_id', 'penghasilan_wali', 'alamat_wali', 'sekolah_id', 'npwp', 'kebutuhan_khusus_mahasiswa', 'informasi_del_id', 'n', 'jurusan_sekolah_id', 'sekolah_dapodik_id', 't_payment_detail'], 'integer'],
            // [['tanggal_lahir', 'tanggal_lahir_ayah', 'tanggal_lahir_ibu', 'tanggal_pendaftaran', 'created_at', 'updated_at'], 'safe'],
            // [['alamat', 'alamat_orang_tua', 'informasi_del_lainnya'], 'string'],
            // [['total_pembayaran'], 'number'],
            // [['nik', 'nik_ayah', 'nik_ibu'], 'string', 'max' => 16],
            // [['nisn', 'akreditasi_sekolah'], 'string', 'max' => 10],
            // [['no_kps', 'virtual_account_number', 'created_by', 'updated_by'], 'string', 'max' => 100],
            // [['nama', 'tempat_lahir', 'email', 'nama_ayah_kandung', 'jurusan_sekolah', 'pas_foto', 'berkas_pendaftaran_ulang'], 'string', 'max' => 128],
            // [['kode_pos', 'no_telepon_rumah', 'no_telepon_mobile', 'nama_ibu_kandung', 'kode_pos_orang_tua', 'no_telepon_mobile_ayah', 'no_telepon_mobile_ibu', 'nama_wali', 'nik_wali', 'no_hp_wali', 'nim'], 'string', 'max' => 45],
            // [['kelurahan'], 'string', 'max' => 32],
            // [['bank_name'], 'string', 'max' => 50],

            [['pendaftar_id', 'jalur_pendaftaran_id', 'user_id'], 'required'],
            [['pendaftar_id', 'jalur_pendaftaran_id', 'user_id'], 'integer'],
            [['nama'], 'string', 'max' => 128],
            [['nik'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'calon_mahasiswa_id' => 'Calon Mahasiswa ID',
            'pendaftar_id' => 'Pendaftar ID',
            'jalur_pendaftaran_id' => 'Jalur Pendaftaran ID',
            // 'cis_imported' => 'Cis Imported',
            // 'jurusan_id' => 'Jurusan ID',
            'user_id' => 'User ID',
            'nik' => 'Nik',
            // 'nisn' => 'Nisn',
            // 'no_kps' => 'No Kps',
            'nama' => 'Nama',
            // 'jenis_kelamin_id' => 'Jenis Kelamin ID',
            // 'golongan_darah_id' => 'Golongan Darah ID',
            // 'tanggal_lahir' => 'Tanggal Lahir',
            // 'tempat_lahir' => 'Tempat Lahir',
            // 'agama_id' => 'Agama ID',
            // 'anak_ke' => 'Anak Ke',
            // 'jumlah_bersaudara' => 'Jumlah Bersaudara',
            // 'jumlah_tanggungan_ortu' => 'Jumlah Tanggungan Ortu',
            // 'alamat' => 'Alamat',
            // 'kode_pos' => 'Kode Pos',
            // 'kelurahan' => 'Kelurahan',
            // 'alamat_kec' => 'Alamat Kec',
            // 'alamat_kab' => 'Alamat Kab',
            // 'alamat_prov' => 'Alamat Prov',
            // 'kewarganegaraan_id' => 'Kewarganegaraan ID',
            // 'no_telepon_rumah' => 'No Telepon Rumah',
            // 'no_telepon_mobile' => 'No Telepon Mobile',
            // 'email' => 'Email',
            // 'nama_ayah_kandung' => 'Nama Ayah Kandung',
            // 'nama_ibu_kandung' => 'Nama Ibu Kandung',
            // 'nik_ayah' => 'Nik Ayah',
            // 'nik_ibu' => 'Nik Ibu',
            // 'tanggal_lahir_ayah' => 'Tanggal Lahir Ayah',
            // 'tanggal_lahir_ibu' => 'Tanggal Lahir Ibu',
            // 'pendidikan_ayah_id' => 'Pendidikan Ayah ID',
            // 'pendidikan_ibu_id' => 'Pendidikan Ibu ID',
            // 'alamat_orang_tua' => 'Alamat Orang Tua',
            // 'kode_pos_orang_tua' => 'Kode Pos Orang Tua',
            // 'alamat_kec_orangtua' => 'Alamat Kec Orangtua',
            // 'alamat_kab_orangtua' => 'Alamat Kab Orangtua',
            // 'alamat_prov_orangtua' => 'Alamat Prov Orangtua',
            // 'pekerjaan_ayah_id' => 'Pekerjaan Ayah ID',
            // 'pekerjaan_ibu_id' => 'Pekerjaan Ibu ID',
            // 'penghasilan_ayah_id' => 'Penghasilan Ayah ID',
            // 'penghasilan_ibu_id' => 'Penghasilan Ibu ID',
            // 'penghasilan_ayah' => 'Penghasilan Ayah',
            // 'penghasilan_ibu' => 'Penghasilan Ibu',
            // 'penghasilan_total' => 'Penghasilan Total',
            // 'no_telepon_mobile_ayah' => 'No Telepon Mobile Ayah',
            // 'no_telepon_mobile_ibu' => 'No Telepon Mobile Ibu',
            // 'nama_wali' => 'Nama Wali',
            // 'nik_wali' => 'Nik Wali',
            // 'no_hp_wali' => 'No Hp Wali',
            // 'pekerjaan_wali_id' => 'Pekerjaan Wali ID',
            // 'penghasilan_wali' => 'Penghasilan Wali',
            // 'alamat_wali' => 'Alamat Wali',
            // 'sekolah_id' => 'Sekolah ID',
            // 'jurusan_sekolah' => 'Jurusan Sekolah',
            // 'akreditasi_sekolah' => 'Akreditasi Sekolah',
            // 'npwp' => 'Npwp',
            // 'kebutuhan_khusus_mahasiswa' => 'Kebutuhan Khusus Mahasiswa',
            // 'informasi_del_id' => 'Informasi Del ID',
            // 'informasi_del_lainnya' => 'Informasi Del Lainnya',
            // 'n' => 'N',
            // 'nim' => 'Nim',
            // 'tanggal_pendaftaran' => 'Tanggal Pendaftaran',
            'status_pembayaran' => 'Status Pembayaran',
            // 'total_pembayaran' => 'Total Pembayaran',
            // 'virtual_account_number' => 'Virtual Account Number',
            // 'bank_name' => 'Bank Name',
            // 'pas_foto' => 'Pas Foto',
            // 'berkas_pendaftaran_ulang' => 'Berkas Pendaftaran Ulang',
            // 'jurusan_sekolah_id' => 'Jurusan Sekolah ID',
            // 'sekolah_dapodik_id' => 'Sekolah Dapodik ID',
            // 'created_at' => 'Created At',
            // 'created_by' => 'Created By',
            // 'updated_at' => 'Updated At',
            // 'updated_by' => 'Updated By',
            // 't_payment_detail' => 'T Payment Detail',
        ];
    }


    public function getPendaftar()
    {
        return $this->hasOne(Pendaftar::class, ['pendaftar_id' => 'pendaftar_id']);
    }

    public function getSekolah()
    {
        return $this->hasOne(Sekolah::class, ['sekolah_id' => 'sekolah_id']);
    }

    public function getNamaJalur()
    {
        return $this->hasOne(JalurPendaftaran::class, ['jalur_pendaftaran_id' => 'jalur_pendaftaran_id']);
    }
    public function getJurusan()
    {
        return $this->hasOne(Jurusan::class, ['jurusan_id' => 'jurusan_id']);
    }
    public function getjenisKelamin()
    {
        return $this->hasOne(JenisKelamin::class, ['jenis_kelamin_id' => 'jenis_kelamin_id']);
    }
    public function getAgama()
    {
        return $this->hasOne(Agama::class, ['agama_id' => 'agama_id']);
    }


    public function getKode()
    {
        return $this->hasOne(KodeUjian::class, ['kode_ujian_id' => 'kode_ujian_id']);
    }
    public function getLokasi()
    {
        return $this->hasOne(LokasiUjian::class, ['lokasi_ujian_id' => 'lokasi_ujian_id']);
    }
}
