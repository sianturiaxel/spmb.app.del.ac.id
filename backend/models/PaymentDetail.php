<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_payment_detail".
 *
 * @property int $payment_detail_id
 * @property int $calon_mahasiswa_id
 * @property float|null $total_amount
 * @property string|null $fee_name
 */
class PaymentDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_payment_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['calon_mahasiswa_id'], 'required'],
            [['calon_mahasiswa_id'], 'integer'],
            [['total_amount'], 'number'],
            [['fee_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_detail_id' => 'Payment Detail ID',
            'calon_mahasiswa_id' => 'Calon Mahasiswa ID',
            'total_amount' => 'Total Amount',
            'fee_name' => 'Fee Name',
        ];
    }
}
