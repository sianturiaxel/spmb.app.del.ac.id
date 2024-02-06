<?php

namespace backend\models\finance;

use Yii;

/**
 * This is the model class for table "finc_t_installment_scheme".
 *
 * @property int $installment_scheme_id
 * @property int $fee_id
 * @property int $order
 * @property float $amount
 * @property string|null $billing_date
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
class InstallmentScheme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finc_t_installment_scheme';
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
            [['fee_id', 'order', 'amount'], 'required'],
            [['fee_id', 'order', 'deleted'], 'integer'],
            [['amount'], 'number'],
            [['billing_date', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
            'installment_scheme_id' => 'Installment Scheme ID',
            'fee_id' => 'Fee ID',
            'order' => 'Order',
            'amount' => 'Amount',
            'billing_date' => 'Billing Date',
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

    public function getInstallmentAmount($feeId, $order){
        $installmentScheme = InstallmentScheme::find()->where(['fee_id' => $feeId, 'order' => $order, 'deleted' => 0])->orderBy(['order' => SORT_DESC])->one();

        if ($installmentScheme) {
            return $installmentScheme->amount;
        }else{
            return 0;
        }        
    }
}
