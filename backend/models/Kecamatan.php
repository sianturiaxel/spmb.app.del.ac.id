<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_kecamatan".
 *
 * @property int $kecamatan_id
 * @property int $kabupaten_id
 * @property string $nama
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_kecamatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kecamatan_id', 'kabupaten_id', 'nama'], 'required'],
            [['kecamatan_id', 'kabupaten_id'], 'integer'],
            [['nama'], 'string', 'max' => 128],
            [['kecamatan_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kecamatan_id' => 'Kode Kecamatan',
            'kabupaten_id' => 'Kabupaten ID',
            'nama' => 'Nama',
        ];
    }

    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['kabupaten_id' => 'kabupaten_id']);
    }
}
