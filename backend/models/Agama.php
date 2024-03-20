<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_agama".
 *
 * @property int $agama_id
 * @property string|null $desc
 */
class Agama extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_agama';
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
            'agama_id' => 'Agama ID',
            'desc' => 'Agama',
        ];
    }
}
