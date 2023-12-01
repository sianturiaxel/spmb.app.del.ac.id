<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_informasi_del".
 *
 * @property int $informasi_del_id
 * @property string|null $desc
 */
class InformasiDel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_informasi_del';
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
            'informasi_del_id' => 'Informasi Del ID',
            'desc' => 'Desc',
        ];
    }
}
