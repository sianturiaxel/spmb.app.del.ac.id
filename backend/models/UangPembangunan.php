<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_uang_pembangunan".
 *
 * @property int $uang_pembangunan_id
 * @property int $gelombang_pendaftaran_id
 * @property int $jurusan_id
 * @property int $minimum_n
 * @property int|null $base_n
 * @property int $multi_n
 */
class UangPembangunan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_uang_pembangunan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gelombang_pendaftaran_id', 'jurusan_id', 'minimum_n', 'multi_n'], 'required'],
            [['gelombang_pendaftaran_id', 'jurusan_id', 'minimum_n', 'base_n', 'multi_n'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uang_pembangunan_id' => 'Uang Pembangunan ID',
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
            'jurusan_id' => 'Jurusan ID',
            'minimum_n' => 'Minimum N',
            'base_n' => 'Base N',
            'multi_n' => 'Multi N',
        ];
    }
    public function getGelombangPendaftaran()
    {
        return $this->hasOne(GelombangPendaftaran::class, ['gelombang_pendaftaran_id' => 'gelombang_pendaftaran_id']);
    }
    public function getJurusan()
    {
        return $this->hasOne(Jurusan::class, ['jurusan_id' => 'jurusan_id']);
    }
}
