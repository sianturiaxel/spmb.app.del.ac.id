<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_mata_pelajaran".
 *
 * @property int $mata_pelajaran_id
 * @property string $name
 * @property string|null $desc
 */
class MataPelajaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_mata_pelajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['desc'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mata_pelajaran_id' => 'Mata Pelajaran ID',
            'name' => 'Name',
            'desc' => 'Desc',
        ];
    }

    public function getJurusans()
    {
        return $this->hasMany(Jurusan::className(), ['jurusan_id' => 'jurusan_id'])
            ->viaTable('t_jurusan_mapel', ['mata_pelajaran_id' => 'mata_pelajaran_id']);
    }
}
