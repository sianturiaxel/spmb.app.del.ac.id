<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_kabupaten".
 *
 * @property int $kabupaten_id
 * @property int $provinsi_id
 * @property string $nama
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_kabupaten';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kabupaten_id', 'provinsi_id', 'nama'], 'required'],
            [['kabupaten_id', 'provinsi_id'], 'integer'],
            [['nama'], 'string', 'max' => 128],
            [['kabupaten_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kabupaten_id' => 'Kabupaten ID',
            'provinsi_id' => 'Provinsi ID',
            'nama' => 'Nama',
        ];
    }
}
