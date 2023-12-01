<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_sekolah".
 *
 * @property int $sekolah_id
 * @property int $provinsi_id
 * @property int $kabupaten_id
 * @property string|null $nama
 * @property string|null $alamat
 * @property string|null $no_telepon
 */
class Sekolah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_sekolah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provinsi_id', 'kabupaten_id'], 'required'],
            [['provinsi_id', 'kabupaten_id'], 'integer'],
            [['alamat'], 'string'],
            [['nama'], 'string', 'max' => 128],
            [['no_telepon'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sekolah_id' => 'Sekolah ID',
            'provinsi_id' => 'Provinsi ID',
            'kabupaten_id' => 'Kabupaten ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'no_telepon' => 'No Telepon',
        ];
    }
}
