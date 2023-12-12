<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_jenis_test".
 *
 * @property int $jenis_test_id
 * @property string|null $nama
 */
class JenisTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_jenis_test';
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
            'jenis_test_id' => 'Jenis Test ID',
            'nama' => 'Nama',
        ];
    }
}
