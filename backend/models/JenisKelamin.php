<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_jenis_kelamin".
 *
 * @property int $jenis_kelamin_id
 * @property string|null $desc
 */
class JenisKelamin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_jenis_kelamin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desc'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jenis_kelamin_id' => 'Jenis Kelamin ID',
            'desc' => 'Desc',
        ];
    }
}
