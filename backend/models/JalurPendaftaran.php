<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_jalur_pendaftaran".
 *
 * @property int $jalur_pendaftaran_id
 * @property string|null $desc
 */
class JalurPendaftaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_jalur_pendaftaran';
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
            'jalur_pendaftaran_id' => 'Jalur Pendaftaran ID',
            'desc' => 'Desc',
        ];
    }
}
