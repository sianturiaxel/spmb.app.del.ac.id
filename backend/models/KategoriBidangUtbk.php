<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_r_kategori_bidang_utbk".
 *
 * @property int $kategori_bidang_utbk_id
 * @property string $name
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 *
 * @property TRBidangUtbk[] $tRBidangUtbks
 */
class KategoriBidangUtbk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_kategori_bidang_utbk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 125],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kategori_bidang_utbk_id' => 'Kategori Bidang Utbk ID',
            'name' => 'Name',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[TRBidangUtbks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriBidangUtbk()
    {
        return $this->hasMany(KategoriBidangUtbk::class, ['kategori_bidang_utbk_id' => 'kategori_bidang_utbk_id']);
    }
}
