<?php

namespace backend\models\finance;

use Yii;

/**
 * This is the model class for table "spmb_t_group_has_gelombang".
 *
 * @property int $group_has_gelombang_id
 * @property int $group_gelombang_id
 * @property int $gelombang_pendaftaran_id
 * @property string|null $desc
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property SpmbRGelombangPendaftaran $gelombangPendaftaran
 * @property SpmbTGroupGelombang $groupGelombang
 */
class GroupHasGelombang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spmb_t_group_has_gelombang';
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
            [['group_gelombang_id', 'gelombang_pendaftaran_id'], 'required'],
            [['group_gelombang_id', 'gelombang_pendaftaran_id', 'deleted'], 'integer'],
            [['desc'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
            [['gelombang_pendaftaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => GelombangPendaftaranFinance::class, 'targetAttribute' => ['gelombang_pendaftaran_id' => 'gelombang_pendaftaran_id']],
            [['group_gelombang_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpmbTGroupGelombang::class, 'targetAttribute' => ['group_gelombang_id' => 'group_gelombang_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'group_has_gelombang_id' => 'Group Has Gelombang ID',
            'group_gelombang_id' => 'Group Gelombang ID',
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
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
     * Gets query for [[GelombangPendaftaran]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGelombangPendaftaran()
    {
        return $this->hasOne(GelombangPendaftaranFinance::class, ['gelombang_pendaftaran_id' => 'gelombang_pendaftaran_id']);
    }

    /**
     * Gets query for [[GroupGelombang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupGelombang()
    {
        return $this->hasOne(SpmbTGroupGelombang::class, ['group_gelombang_id' => 'group_gelombang_id']);
    }
}
