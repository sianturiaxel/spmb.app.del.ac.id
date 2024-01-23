<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_nilai_akademik".
 *
 * @property int $nilai_akademik_id
 * @property int $pendaftar_id
 * @property int|null $mat_benar
 * @property int|null $mat_salah
 * @property int|null $ing_benar
 * @property int|null $ing_salah
 * @property int|null $tpa_benar
 * @property int|null $tpa_salah
 * @property int|null $total_kosong
 * @property string|null $mp_tinggi
 * @property string|null $mp_rendah
 * @property string|null $perbandingan_mat_ing
 * @property int|null $jumlah_soal
 * @property int|null $hasil_score
 * @property float|null $scala_score
 * @property string|null $usulan_panitia
 * @property string|null $pilihan1
 * @property string|null $pilihan2
 * @property string|null $pilihan3
 * @property string|null $hasil_akhir_pilihan
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 */
class NilaiAkademik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $excelFile;

    public static function tableName()
    {
        return 't_nilai_akademik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pendaftar_id', 'mat_benar', 'mat_salah', 'ing_benar', 'ing_salah', 'tpa_benar', 'tpa_salah', 'total_kosong', 'jumlah_soal', 'hasil_score'], 'integer'],
            [['scala_score'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['mp_tinggi', 'mp_rendah', 'perbandingan_mat_ing', 'usulan_panitia', 'pilihan1', 'pilihan2', 'pilihan3', 'hasil_akhir_pilihan', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nilai_akademik_id' => 'Nilai Akademik ID',
            'pendaftar_id' => 'Pendaftar ID',
            'mat_benar' => 'Mat Benar',
            'mat_salah' => 'Mat Salah',
            'ing_benar' => 'Ing Benar',
            'ing_salah' => 'Ing Salah',
            'tpa_benar' => 'Tpa Benar',
            'tpa_salah' => 'Tpa Salah',
            'total_kosong' => 'Total Kosong',
            'mp_tinggi' => 'Mp Tinggi',
            'mp_rendah' => 'Mp Rendah',
            'perbandingan_mat_ing' => 'Perbandingan Mat Ing',
            'jumlah_soal' => 'Jumlah Soal',
            'hasil_score' => 'Hasil Score',
            'scala_score' => 'Scala Score',
            'usulan_panitia' => 'Usulan Panitia',
            'pilihan1' => 'Pilihan1',
            'pilihan2' => 'Pilihan2',
            'pilihan3' => 'Pilihan3',
            'hasil_akhir_pilihan' => 'Hasil Akhir Pilihan',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }
    public function getPendaftar()
    {
        return $this->hasOne(Pendaftar::class, ['pendaftar_id' => 'pendaftar_id']);
    }
}
