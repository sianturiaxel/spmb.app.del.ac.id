<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_pekerjaan".
 *
 * @property int $pekerjaan_id
 * @property string|null $nama
 */
class Pekerjaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_pekerjaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pekerjaan_id' => 'Pekerjaan ID',
            'nama' => 'Nama',
        ];
    }
}
