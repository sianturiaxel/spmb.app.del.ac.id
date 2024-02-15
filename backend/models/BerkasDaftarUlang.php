<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_berkas_daftar_ulang".
 *
 * @property int $berkas_daftar_ulang_id
 * @property string $name
 * @property string|null $desc
 * @property string|null $berkas
 * @property string|null $link
 * @property int|null $is_active
 * @property int|null $deleted
 */
class BerkasDaftarUlang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_berkas_daftar_ulang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['desc'], 'string'],
            [['is_active', 'deleted'], 'integer'],
            [['name', 'berkas', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'berkas_daftar_ulang_id' => 'Berkas Daftar Ulang ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'berkas' => 'Berkas',
            'link' => 'Link',
            'is_active' => 'Status',
            'deleted' => 'Deleted',
        ];
    }
}
