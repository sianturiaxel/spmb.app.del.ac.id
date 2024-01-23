<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_provinsi".
 *
 * @property int $provinsi_id
 * @property string $nama
 */
class Provinsi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_provinsi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provinsi_id', 'nama'], 'required'],
            [['provinsi_id'], 'integer'],
            [['nama'], 'string', 'max' => 128],
            [['provinsi_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'provinsi_id' => 'Provinsi ID',
            'nama' => 'Nama',
        ];
    }
}
