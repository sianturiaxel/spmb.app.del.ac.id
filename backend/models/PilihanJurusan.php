<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_pilihan_jurusan".
 *
 * @property int $pilihan_jurusan_id
 * @property int $pendaftar_id
 * @property int $jurusan_id
 * @property int $prioritas
 * @property int $lulus
 */
class PilihanJurusan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_pilihan_jurusan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pendaftar_id', 'jurusan_id', 'prioritas'], 'required'],
            [['pendaftar_id', 'jurusan_id', 'prioritas', 'lulus'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pilihan_jurusan_id' => 'Pilihan Jurusan ID',
            'pendaftar_id' => 'Pendaftar ID',
            'jurusan_id' => 'Jurusan ID',
            'prioritas' => 'Prioritas',
            'lulus' => 'Lulus',
        ];
    }

    public function getJurusan()
    {
        return $this->hasOne(Jurusan::className(), ['jurusan_id' => 'jurusan_id']);
    }

    public function getPendaftar()
    {
        return $this->hasOne(Pendaftar::className(), ['pendaftar_id' => 'pendaftar_id']);
    }
}
