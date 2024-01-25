<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "finc_t_fee".
 *
 * @property int $fee_id
 * @property string|null $name
 * @property int|null $fee_reference_id
 * @property string|null $payment_type_key
 * @property int|null $is_fix
 * @property int|null $is_active
 * @property float|null $amount
 * @property int $is_spmb
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property FincRFeeReference $feeReference
 * @property FincTInstallmentScheme[] $fincTInstallmentSchemes
 * @property FincRPaymentType $paymentTypeKey
 */
class FincTFee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function getDb()
    {
        return Yii::$app->get('db1');
    }

    public static function tableName()
    {
        return 'finc_t_fee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fee_reference_id', 'is_fix', 'is_active', 'is_spmb', 'deleted'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['payment_type_key'], 'string', 'max' => 45],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
            // [['fee_reference_id'], 'exist', 'skipOnError' => true, 'targetClass' => FincRFeeReference::class, 'targetAttribute' => ['fee_reference_id' => 'fee_reference_id']],
            // [['payment_type_key'], 'exist', 'skipOnError' => true, 'targetClass' => FincRPaymentType::class, 'targetAttribute' => ['payment_type_key' => 'key']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fee_id' => 'Fee ID',
            'name' => 'Name',
            'fee_reference_id' => 'Fee Reference ID',
            'payment_type_key' => 'Payment Type Key',
            'is_fix' => 'Is Fix',
            'is_active' => 'Is Active',
            'amount' => 'Amount',
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
     * Gets query for [[FeeReference]].
     *
     * @return \yii\db\ActiveQuery
     */
}
