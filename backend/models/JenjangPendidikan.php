<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_jenjang_pendidikan".
 *
 * @property int $jenjang_pendidikan_id
 * @property string|null $name
 */
class JenjangPendidikan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_jenjang_pendidikan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jenjang_pendidikan_id' => 'Jenjang Pendidikan ID',
            'name' => 'Name',
        ];
    }
}
