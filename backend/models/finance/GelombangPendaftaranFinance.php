<?php

namespace backend\models\finance;

use Yii;

/**
 * This is the model class for table "spmb_r_gelombang_pendaftaran".
 *
 * @property int $gelombang_pendaftaran_id
 * @property string $name
 * @property string|null $desc
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property SpmbTGroupHasGelombang[] $spmbTGroupHasGelombangs
 */
class GelombangPendaftaranFinance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spmb_r_gelombang_pendaftaran';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_finance');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gelombang_pendaftaran_id', 'name'], 'required'],
            [['gelombang_pendaftaran_id', 'deleted'], 'integer'],
            [['desc'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
            [['gelombang_pendaftaran_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    /**
     * Gets query for [[SpmbTGroupHasGelombangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpmbTGroupHasGelombangs()
    {
        return $this->hasMany(GroupHasGelombang::class, ['gelombang_pendaftaran_id' => 'gelombang_pendaftaran_id']);
    }
}
