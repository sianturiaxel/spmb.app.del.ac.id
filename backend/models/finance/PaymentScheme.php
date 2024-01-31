<?php

namespace backend\models\finance;

use Yii;

/**
 * This is the model class for table "finc_t_payment_scheme".
 *
 * @property int $payment_scheme_id
 * @property string $payment_scheme_number
 * @property string|null $name
 * @property int $fee_id
 * @property int $is_spmb
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property FincTFee $fee
 */
class PaymentScheme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finc_t_payment_scheme';
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
            [['payment_scheme_number', 'fee_id'], 'required'],
            [['fee_id', 'is_spmb', 'deleted'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['payment_scheme_number'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 100],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
            [['fee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fee::class, 'targetAttribute' => ['fee_id' => 'fee_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_scheme_id' => 'Payment Scheme ID',
            'payment_scheme_number' => 'Payment Scheme Number',
            'name' => 'Name',
            'fee_id' => 'Fee ID',
            'is_spmb' => 'Is Spmb',
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
     * Gets query for [[Fee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFee()
    {
        return $this->hasOne(Fee::class, ['fee_id' => 'fee_id']);
    }
}
