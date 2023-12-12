<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_sekolah_pmdk".
 *
 * @property int $sekolah_pmdk_id
 * @property int|null $sekolah_id
 */
class SekolahPmdk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_sekolah_pmdk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sekolah_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sekolah_pmdk_id' => 'Sekolah Pmdk ID',
            'sekolah_id' => 'Sekolah ID',
        ];
    }
    public function getSekolah()
    {
        return $this->hasOne(Sekolah::className(), ['sekolah_id' => 'sekolah_id']);
    }
}
