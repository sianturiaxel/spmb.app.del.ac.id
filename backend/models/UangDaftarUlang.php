<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_uang_daftar_ulang".
 *
 * @property int $uang_daftar_ulang_id
 * @property int $gelombang_pendaftaran_id
 * @property int $perlengkapan_mhs
 * @property int $perlengkapan_makan
 * @property int $spp_tahap_1
 */
class UangDaftarUlang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_uang_daftar_ulang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gelombang_pendaftaran_id', 'perlengkapan_mhs', 'perlengkapan_makan', 'spp_tahap_1'], 'required'],
            [['gelombang_pendaftaran_id', 'perlengkapan_mhs', 'perlengkapan_makan', 'spp_tahap_1'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uang_daftar_ulang_id' => 'Uang Daftar Ulang ID',
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
            'perlengkapan_mhs' => 'Perlengkapan Mhs',
            'perlengkapan_makan' => 'Perlengkapan Makan',
            'spp_tahap_1' => 'Spp Tahap 1',
        ];
    }
}
