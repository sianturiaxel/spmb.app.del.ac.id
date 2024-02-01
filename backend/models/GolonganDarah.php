<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_golongan_darah".
 *
 * @property int $golongan_darah_id
 * @property string|null $desc
 */
class GolonganDarah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_golongan_darah';
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
            'golongan_darah_id' => 'Golongan Darah ID',
            'desc' => 'Desc',
        ];
    }
}
