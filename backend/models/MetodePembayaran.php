<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_metode_pembayaran".
 *
 * @property int $metode_pembayaran_id
 * @property string|null $desc
 */
class MetodePembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_metode_pembayaran';
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
            'metode_pembayaran_id' => 'Metode Pembayaran ID',
            'desc' => 'Desc',
        ];
    }
}
