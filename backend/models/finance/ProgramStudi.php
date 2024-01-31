<?php

namespace backend\models\finance;

use Yii;

/**
 * This is the model class for table "spmb_t_program_studi".
 *
 * @property int $program_studi_id
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property SpmbTPaymentSchemeMapping[] $spmbTPaymentSchemeMappings
 * @property SpmbTUserRegistrationNumber[] $spmbTUserRegistrationNumbers
 */
class ProgramStudi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spmb_t_program_studi';
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
            [['name'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['deleted'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'program_studi_id' => 'Program Studi ID',
            'name' => 'Name',
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
     * Gets query for [[SpmbTPaymentSchemeMappings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpmbTPaymentSchemeMappings()
    {
        return $this->hasMany(PaymentSchemeMapping::class, ['program_studi_id' => 'program_studi_id']);
    }

    /**
     * Gets query for [[SpmbTUserRegistrationNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpmbTUserRegistrationNumbers()
    {
        return $this->hasMany(UserRegistrationNumber::class, ['program_studi_id' => 'program_studi_id']);
    }
}
