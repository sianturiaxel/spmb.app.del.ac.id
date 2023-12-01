<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_nilai_wawancara".
 *
 * @property int $nilai_wawancara_id
 * @property int $pendaftar_id
 * @property float|null $nilai_motivasi
 * @property float|null $nilai_gambaran_karir
 * @property float|null $nilai_rekomendasi
 */
class NilaiWawancara extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $excelFile;


    public static function tableName()
    {
        return 't_nilai_wawancara';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nilai_wawancara_id'], 'integer'],
            [['pendaftar_id'], 'integer'],
            [['nilai_motivasi', 'nilai_gambaran_karir', 'nilai_rekomendasi'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nilai_wawancara_id' => 'Nilai Wawancara ID',
            'pendaftar_id' => 'Pendaftar ID',
            'nilai_motivasi' => 'Nilai Motivasi',
            'nilai_gambaran_karir' => 'Nilai Gambaran Karir',
            'nilai_rekomendasi' => 'Nilai Rekomendasi',

        ];
    }

    public function getPendaftar()
    {
        return $this->hasOne(Pendaftar::class, ['pendaftar_id' => 'pendaftar_id']);
    }
}
