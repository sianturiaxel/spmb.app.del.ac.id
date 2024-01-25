<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_biaya_pendaftaran".
 *
 * @property int $biaya_pendaftaran_id
 * @property int $gelombang_pendaftaran_id
 * @property float|null $biaya_daftar
 */
class BiayaPendaftaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_biaya_pendaftaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gelombang_pendaftaran_id'], 'required'],
            [['gelombang_pendaftaran_id'], 'integer'],
            [['fee_id'], 'integer'],
            [['biaya_daftar'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'biaya_pendaftaran_id' => 'Biaya Pendaftaran ID',
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
            'fee_id' => 'Fee ID',
            'biaya_daftar' => 'Biaya Daftar',
        ];
    }

    public function getGelombang()
    {
        return $this->hasOne(GelombangPendaftaran::class, ['gelombang_pendaftaran_id' => 'gelombang_pendaftaran_id']);
    }

    public function getFincTFee()
    {
        return $this->hasOne(FincTFee::className(), ['fee_id' => 'fee_id']);
    }
}
