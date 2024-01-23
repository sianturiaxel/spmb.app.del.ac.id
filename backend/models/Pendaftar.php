<?php

namespace backend\models;

use backend\models\JalurPendaftaran;
use yii\web\UploadedFile;
use backend\models\JalurPendaftaran as ModelsJalurPendaftaran;
use yii\data\ActiveDataProvider;
use yii\helpers\Security;
use Yii;


/**
 * This is the model class for table "t_pendaftar".
 *
 * @property int $pendaftar_id
 * @property int $jalur_pendaftaran_id
 * @property int $user_id
 * @property string|null $nik
 * @property string|null $nisn
 * @property int|null $penerima_kps
 * @property string|null $no_kps
 * @property string|null $nama
 * @property int $jenis_kelamin_id
 * @property string|null $tanggal_lahir
 * @property string|null $tempat_lahir
 * @property int $agama_id
 * @property string|null $alamat
 * @property string|null $kode_pos
 * @property string|null $kelurahan
 * @property int|null $kecamatan_id
 * @property int|null $kabupaten_id
 * @property int|null $provinsi_id
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
 * @property int|null $alamat_kec_orangtua
 * @property int|null $alamat_kab_orangtua
 * @property int|null $alamat_prov_orangtua
 * @property string|null $alamat_orang_tua
 * @property string|null $kode_pos_orang_tua
 * @property int|null $pekerjaan_ayah_id
 * @property int|null $pekerjaan_ibu_id
 * @property int|null $penghasilan_ayah
 * @property int|null $penghasilan_ibu
 * @property int|null $penghasilan_total
 * @property int $sekolah_id
 * @property string|null $jurusan_sekolah
 * @property string|null $akreditasi_sekolah
 * @property int $npwp
 * @property string $kebutuhan_khusus_mahasiswa
 * @property int|null $kemampuan_bahasa_inggris
 * @property string|null $bahasa_asing_lainnya
 * @property int|null $kemampuan_bahasa_asing_lainnya
 * @property int $informasi_del_id
 * @property string|null $informasi_del_lainnya
 * @property int $n
 * @property string|null $tanggal_pendaftaran
 * @property int|null $metode_pembayaran_id
 * @property string|null $file_verifikasi_pembayaran
 * @property string|null $pas_foto
 * @property string|null $file_nilai_rapor
 * @property string|null $file_sertifikat
 * @property string|null $file_formulir
 * @property string|null $file_rekomendasi
 * @property string|null $prefix_kode_pendaftaran
 * @property int|null $no_pendaftaran
 * @property int $status_pendaftaran_id
 * @property int|null $status_administrasi_id
 * @property int $status_test_akademik_id
 * @property int $status_test_psikologi_id
 * @property int $status_kelulusan
 * @property int $gelombang_pendaftaran_id
 * @property int $lokasi_ujian_id
 * @property int $kode_ujian_id
 * @property int|null $jurusan_sekolah_id
 * @property int|null $sekolah_dapodik_id
 * @property string|null $no_hp_orangtua
 * @property string|null $motivasi
 * @property string|null $hobby
 * @property string|null $kab_domisili
 * @property string|null $virtual_account
 * @property string|null $voucher_daftar
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 */
class Pendaftar extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_pendaftar';
    }

    public $fileInstance; // Atribut baru untuk instance UploadedFile

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_nilai_rapor'], 'string'], // Ini adalah path file yang disimpan sebagai string
            [['fileInstance'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, doc, docx'],
            //[['jalur_pendaftaran_id', 'user_id', 'jenis_kelamin_id', 'agama_id', 'kewarganegaraan_id', 'sekolah_id', 'npwp', 'kebutuhan_khusus_mahasiswa', 'informasi_del_id', 'n', 'gelombang_pendaftaran_id', 'lokasi_ujian_id', 'kode_ujian_id'], 'required'],
            [['penghasilan_ayah', 'penghasilan_ibu', 'penghasilan_total'], 'convertRupiahToInt', 'skipOnEmpty' => true],
            [['jalur_pendaftaran_id', 'user_id', 'penerima_kps', 'jenis_kelamin_id', 'agama_id', 'alamat_kec', 'alamat_kab', 'alamat_prov', 'pendidikan_ayah_id', 'pendidikan_ibu_id', 'alamat_kec_orangtua', 'alamat_kab_orangtua', 'alamat_prov_orangtua', 'pekerjaan_ayah_id', 'pekerjaan_ibu_id', 'sekolah_id', 'no_npwp', 'kemampuan_bahasa_inggris', 'kemampuan_bahasa_asing_lainnya', 'informasi_del_id', 'n', 'metode_pembayaran_id', 'no_pendaftaran', 'status_pendaftaran_id', 'status_adminstrasi_id', 'status_test_akademik_id', 'status_test_psikologi_id', 'status_kelulusan', 'gelombang_pendaftaran_id', 'lokasi_ujian_id', 'kode_ujian_id', 'jurusan_sekolah_id', 'sekolah_dapodik_id'], 'integer'],
            [['tanggal_lahir', 'tanggal_lahir_ayah', 'tanggal_lahir_ibu', 'tanggal_pendaftaran', 'created_at', 'updated_at'], 'safe'],
            [['alamat', 'alamat_orang_tua', 'informasi_del_lainnya', 'motivasi'], 'string'],
            [['nik', 'nik_ayah', 'nik_ibu'], 'string', 'max' => 16],
            [['nisn', 'prefix_kode_pendaftaran'], 'string', 'max' => 10],
            [['no_kps', 'akreditasi_sekolah', 'kab_domisili', 'virtual_account', 'voucher_daftar', 'created_by', 'updated_by'], 'string', 'max' => 100],
            [['nama', 'tempat_lahir', 'email', 'nama_ayah_kandung', 'jurusan_sekolah', 'file_verifikasi_pembayaran', 'pas_foto', 'file_sertifikat', 'file_formulir', 'file_rekomendasi'], 'string', 'max' => 128],
            [['kode_pos', 'no_telepon_rumah', 'no_telepon_mobile', 'nama_ibu_kandung', 'kode_pos_orang_tua', 'bahasa_asing_lainnya', 'no_hp_orangtua'], 'string', 'max' => 45],
            [['kelurahan'], 'string', 'max' => 32],
            [['kebutuhan_khusus_mahasiswa'], 'string', 'max' => 225],
            [['hobby'], 'string', 'max' => 235],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pendaftar_id' => 'Pendaftar ID',
            //'jalur_pendaftaran_id' => 'Jalur Pendaftaran ID',
            'user_id' => 'User ID',
            'nik' => 'Nik',
            'nisn' => 'Nisn',
            'penerima_kps' => 'Penerima Kps',
            'no_kps' => 'No Kps',
            'nama' => 'Nama',
            'jenis_kelamin_id' => 'Jenis Kelamin ID',
            'tanggal_lahir' => 'Tanggal Lahir',
            'tempat_lahir' => 'Tempat Lahir',
            'agama_id' => 'Agama ID',
            'alamat' => 'Alamat',
            'kode_pos' => 'Kode Pos',
            'kelurahan' => 'Kelurahan',
            'kecamatan_id' => 'Kecamatan ID',
            'kabupaten_id' => 'Kabupaten ID',
            'provinsi_id' => 'Provinsi ID',
            //'kewarganegaraan_id' => 'Kewarganegaraan ID',
            'no_telepon_rumah' => 'No Telepon Rumah',
            'no_telepon_mobile' => 'No Telepon Mobile',
            'email' => 'Email',
            'nama_ayah_kandung' => 'Nama Ayah Kandung',
            'nama_ibu_kandung' => 'Nama Ibu Kandung',
            'nik_ayah' => 'Nik Ayah',
            'nik_ibu' => 'Nik Ibu',
            'tanggal_lahir_ayah' => 'Tanggal Lahir Ayah',
            'tanggal_lahir_ibu' => 'Tanggal Lahir Ibu',
            'pendidikan_ayah_id' => 'Pendidikan Ayah ID',
            'pendidikan_ibu_id' => 'Pendidikan Ibu ID',
            'alamat_kec_orangtua' => 'Alamat Kec Orangtua',
            'alamat_kab_orangtua' => 'Alamat Kab Orangtua',
            'alamat_prov_orangtua' => 'Alamat Prov Orangtua',
            'alamat_orang_tua' => 'Alamat Orang Tua',
            'kode_pos_orang_tua' => 'Kode Pos Orang Tua',
            'pekerjaan_ayah_id' => 'Pekerjaan Ayah ID',
            'pekerjaan_ibu_id' => 'Pekerjaan Ibu ID',
            'penghasilan_ayah' => 'Penghasilan Ayah',
            'penghasilan_ibu' => 'Penghasilan Ibu',
            'penghasilan_total' => 'Penghasilan Total',
            'sekolah_id' => 'Sekolah ID',
            'jurusan_sekolah' => 'Jurusan Sekolah',
            'akreditasi_sekolah' => 'Akreditasi Sekolah',
            'no_npwp' => 'Npwp',
            'kebutuhan_khusus_mahasiswa' => 'Kebutuhan Khusus Mahasiswa',
            'kemampuan_bahasa_inggris' => 'Kemampuan Bahasa Inggris',
            'bahasa_asing_lainnya' => 'Bahasa Asing Lainnya',
            'kemampuan_bahasa_asing_lainnya' => 'Kemampuan Bahasa Asing Lainnya',
            'informasi_del_id' => 'Informasi Del ID',
            'informasi_del_lainnya' => 'Informasi Del Lainnya',
            'n' => 'N',
            'tanggal_pendaftaran' => 'Tanggal Pendaftaran',
            'metode_pembayaran_id' => 'Metode Pembayaran ID',
            'file_verifikasi_pembayaran' => 'File Verifikasi Pembayaran',
            'pas_foto' => 'Pas Foto',
            'file_nilai_rapor' => 'File Nilai Rapor',
            'file_sertifikat' => 'File Sertifikat',
            'file_formulir' => 'File Formulir',
            'file_rekomendasi' => 'File Rekomendasi',
            'prefix_kode_pendaftaran' => 'Prefix Kode Pendaftaran',
            'no_pendaftaran' => 'No Pendaftaran',
            'status_pendaftaran_id' => 'Status Pendaftaran ID',
            'status_adminstrasi_id' => 'Status Adminstrasi ID',
            'status_wawancara_id' => 'Status Wawancara ID',
            'status_test_akademik_id' => 'Status Test Akademik ID',
            'status_test_psikologi_id' => 'Status Test Psikologi ID',
            'status_kelulusan' => 'Status Kelulusan',
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
            'lokasi_ujian_id' => 'Lokasi Ujian ID',
            'kode_ujian_id' => 'Kode Ujian ID',
            'jurusan_sekolah_id' => 'Jurusan Sekolah ID',
            'sekolah_dapodik_id' => 'Sekolah Dapodik ID',
            'no_hp_orangtua' => 'No Hp Orangtua',
            'motivasi' => 'Motivasi',
            'hobby' => 'Hobby',
            'kab_domisili' => 'Kab Domisili',
            'virtual_account' => 'Virtual Account',
            'voucher_daftar' => 'Voucher Daftar',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function convertRupiahToInt($attribute, $params)
    {
        if (is_string($this->$attribute)) {
            $this->$attribute = (int) str_replace(['Rp', '.', ','], '', $this->$attribute);
        }
    }


    public function search($params)
    {
        $query = self::find();
        // ... tambahkan logika pencarian di sini ...
        return new ActiveDataProvider([
            'query' => $query,
            // ... konfigurasi lainnya ...
        ]);
    }

    public function getSekolahId()
    {
        return $this->hasOne(SekolahDapodik::class, ['id' => 'sekolah_id']);
    }

    public function getJalurPendaftaran()
    {
        return $this->hasOne(JalurPendaftaran::class, ['jalur_pendaftaran_id' => 'jalur_pendaftaran_id']);
    }
    public function getGelombangPendaftaran()
    {
        return $this->hasOne(GelombangPendaftaran::class, ['gelombang_pendaftaran_id' => 'gelombang_pendaftaran_id']);
    }

    public function getJenisKelamin()
    {
        return $this->hasOne(JenisKelamin::class, ['jenis_kelamin_id' => 'jenis_kelamin_id']);
    }
    public function getAgama()
    {
        return $this->hasOne(Agama::class, ['agama_id' => 'agama_id']);
    }

    public function getstatusPendaftaran()
    {
        return $this->hasOne(StatusPendaftaran::class, ['status_pendaftaran_id' => 'status_pendaftaran_id']);
    }

    public function getKode()
    {
        return $this->hasOne(KodeUjian::class, ['kode_ujian_id' => 'kode_ujian_id']);
    }

    public function getLokasi()
    {
        return $this->hasOne(LokasiUjian::class, ['lokasi_ujian_id' => 'lokasi_ujian_id']);
    }

    public function getPilihanJurusan()
    {
        return $this->hasOne(PilihanJurusan::class, ['pendaftar_id' => 'pendaftar_id']);
    }

    public function getPekerjaanAyah()
    {
        return $this->hasOne(Pekerjaan::class, ['pekerjaan_id' => 'pekerjaan_ayah_id']);
    }
    public function getPekerjaanIbu()
    {
        return $this->hasOne(Pekerjaan::class, ['pekerjaan_id' => 'pekerjaan_ibu_id']);
    }
    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::class, ['kecamatan_id' => 'alamat_kec']);
    }
    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::class, ['kabupaten_id' => 'alamat_kab']);
    }
    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::class, ['provinsi_id' => 'alamat_prov']);
    }
    public function getKecamatanOrangtua()
    {
        return $this->hasOne(Kecamatan::class, ['kecamatan_id' => 'alamat_kec_orangtua']);
    }
    public function getKabupatenOrangtua()
    {
        return $this->hasOne(Kabupaten::class, ['kabupaten_id' => 'alamat_kab_orangtua']);
    }
    public function getProvinsiOrangtua()
    {
        return $this->hasOne(Provinsi::class, ['provinsi_id' => 'alamat_prov_orangtua']);
    }
    public function getPendidikanAyah()
    {
        return $this->hasOne(JenjangPendidikan::class, ['jenjang_pendidikan_id' => 'pendidikan_ayah_id']);
    }
    public function getPendidikanIbu()
    {
        return $this->hasOne(JenjangPendidikan::class, ['jenjang_pendidikan_id' => 'pendidikan_ibu_id']);
    }

    public function getKemampuanBahasaInggris()
    {
        return $this->hasOne(KemampuanBahasa::class, ['kemampuan_bahasa_id' => 'kemampuan_bahasa_inggris']);
    }
    public function getKemampuanBahasaAsing()
    {
        return $this->hasOne(KemampuanBahasa::class, ['kemampuan_bahasa_id' => 'kemampuan_bahasa_asing_lainnya']);
    }
    public function getMetodePendaftaran()
    {
        return $this->hasOne(MetodePembayaran::class, ['metode_pembayaran_id' => 'metode_pembayaran_id']);
    }

    public function upload()
    {
        if ($this->validate(['fileInstance'])) { // Pastikan untuk memvalidasi atribut fileInstance
            $fileName = $this->fileInstance->baseName . '.' . $this->fileInstance->extension;
            $path = Yii::getAlias('@webroot/uploads/') . $fileName;
            if ($this->fileInstance->saveAs($path)) {
                $this->file_nilai_rapor = $fileName; // Simpan nama file ke atribut yang benar
                return true;
            }
        }
        return false;
    }
}
