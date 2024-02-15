<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_jurusan_sekolah".
 *
 * @property int $jurusan_sekolah_id
 * @property string|null $nama
 * @property int|null $isactive
 * @property string|null $tingkat
 */
class JurusanSekolah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_jurusan_sekolah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isactive'], 'integer'],
            [['tingkat'], 'string'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jurusan_sekolah_id' => 'Jurusan Sekolah ID',
            'nama' => 'Nama',
            'isactive' => 'Status',
            'tingkat' => 'Tingkat',
        ];
    }
}
