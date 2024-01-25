<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_sekolah_dapodik".
 *
 * @property int $id
 * @property string|null $id_dapodik
 * @property string|null $npsn
 * @property string|null $kode_prop
 * @property string|null $propinsi
 * @property string|null $kode_kab_kota
 * @property string|null $kabupaten_kota
 * @property string|null $kode_kec
 * @property string|null $kecamatan
 * @property string|null $bentuk
 * @property string|null $sekolah
 * @property string|null $status
 * @property string|null $alamat_jalan
 * @property string|null $lintang
 * @property string|null $bujur
 * @property string|null $jumlah_siswa_lk
 * @property string|null $jumlah_siswa_pr
 * @property string|null $telp
 * @property string|null $fax
 */
class SekolahDapodik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_sekolah_dapodik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_dapodik', 'npsn', 'kode_prop', 'propinsi', 'kode_kab_kota', 'kabupaten_kota', 'kode_kec', 'kecamatan', 'bentuk', 'sekolah', 'status', 'alamat_jalan', 'lintang', 'bujur', 'jumlah_siswa_lk', 'jumlah_siswa_pr', 'telp', 'fax'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_dapodik' => 'Id Dapodik',
            'npsn' => 'Npsn',
            'kode_prop' => 'Kode Prop',
            'propinsi' => 'Propinsi',
            'kode_kab_kota' => 'Kode Kab Kota',
            'kabupaten_kota' => 'Kabupaten Kota',
            'kode_kec' => 'Kode Kec',
            'kecamatan' => 'Kecamatan',
            'bentuk' => 'Bentuk',
            'sekolah' => 'Sekolah',
            'status' => 'Status',
            'alamat_jalan' => 'Alamat Jalan',
            'lintang' => 'Lintang',
            'bujur' => 'Bujur',
            'jumlah_siswa_lk' => 'Jumlah Siswa Lk',
            'jumlah_siswa_pr' => 'Jumlah Siswa Pr',
            'telp' => 'Telp',
            'fax' => 'Fax',
        ];
    }
}
