<?php

namespace backend\models\finance;

use Yii;

/**
 * This is the model class for table "spmb_t_payment_scheme_mapping".
 *
 * @property int $payment_scheme_mapping_id
 * @property int $program_studi_id
 * @property int $group_gelombang_id
 * @property int $n
 * @property string $payment_scheme_number
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property SpmbTGroupGelombang $groupGelombang
 * @property SpmbTProgramStudi $programStudi
 */
class PaymentSchemeMapping extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spmb_t_payment_scheme_mapping';
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
            [['program_studi_id', 'group_gelombang_id', 'n', 'payment_scheme_number'], 'required'],
            [['program_studi_id', 'group_gelombang_id', 'n', 'deleted'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['payment_scheme_number', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 45],
            [['group_gelombang_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpmbTGroupGelombang::class, 'targetAttribute' => ['group_gelombang_id' => 'group_gelombang_id']],
            [['program_studi_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramStudi::class, 'targetAttribute' => ['program_studi_id' => 'program_studi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_scheme_mapping_id' => 'Payment Scheme Mapping ID',
            'program_studi_id' => 'Program Studi ID',
            'group_gelombang_id' => 'Group Gelombang ID',
            'n' => 'N',
            'payment_scheme_number' => 'Payment Scheme Number',
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
     * Gets query for [[GroupGelombang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupGelombang()
    {
        return $this->hasOne(SpmbTGroupGelombang::class, ['group_gelombang_id' => 'group_gelombang_id']);
    }

    /**
     * Gets query for [[ProgramStudi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramStudi()
    {
        return $this->hasOne(ProgramStudi::class, ['program_studi_id' => 'program_studi_id']);
    }
}
