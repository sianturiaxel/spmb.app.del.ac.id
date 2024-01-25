<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_kemampuan_bahasa".
 *
 * @property int $kemampuan_bahasa_id
 * @property string|null $desc
 */
class KemampuanBahasa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_kemampuan_bahasa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desc'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kemampuan_bahasa_id' => 'Kemampuan Bahasa ID',
            'desc' => 'Desc',
        ];
    }
}
