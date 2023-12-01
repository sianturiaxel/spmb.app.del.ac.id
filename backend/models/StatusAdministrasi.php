<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_status_adminstrasi".
 *
 * @property int $status_administrasi_id
 * @property string|null $nama
 */
class StatusAdminstrasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_status_adminstrasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_administrasi_id' => 'Status Administrasi ID',
            'nama' => 'Nama',
        ];
    }
}
