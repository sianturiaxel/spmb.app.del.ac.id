<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_jurusan_mapel".
 *
 * @property int $jurusan_mapel_id
 * @property int $jurusan_id
 * @property int $mata_pelajaran_id
 */
class JurusanMapel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_jurusan_mapel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jurusan_id', 'mata_pelajaran_id'], 'required'],
            [['jurusan_id', 'mata_pelajaran_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jurusan_mapel_id' => 'Jurusan Mapel ID',
            'jurusan_id' => 'Jurusan ID',
            'mata_pelajaran_id' => 'Mata Pelajaran ID',
        ];
    }
}
