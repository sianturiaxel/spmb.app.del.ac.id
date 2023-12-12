<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_jenis_ujian".
 *
 * @property int $jenis_ujian_id
 * @property string $name
 * @property string|null $desc
 */
class JenisUjian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_jenis_ujian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['desc'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jenis_ujian_id' => 'Jenis Ujian ID',
            'name' => 'Name',
            'desc' => 'Desc',
        ];
    }
}
