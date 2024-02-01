<?php

namespace backend\models\finance;

use Yii;

/**
 * This is the model class for table "finc_t_user_has_payment_scheme".
 *
 * @property int $user_has_payment_scheme_id
 * @property int $user_id
 * @property string $payment_scheme_number
 * @property int|null $periode_id
 * @property int|null $order
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @property FincRPeriode $periode
 * @property SysxUser $user
 */
class UserHasPaymentScheme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finc_t_user_has_payment_scheme';
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
            [['user_id', 'payment_scheme_number'], 'required'],
            [['user_id', 'periode_id', 'order', 'deleted'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['payment_scheme_number'], 'string', 'max' => 45],
            [['created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserFinance::class, 'targetAttribute' => ['user_id' => 'user_id']],
            [['periode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Periode::class, 'targetAttribute' => ['periode_id' => 'periode_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_has_payment_scheme_id' => 'User Has Payment Scheme ID',
            'user_id' => 'User ID',
            'payment_scheme_number' => 'Payment Scheme Number',
            'periode_id' => 'Periode ID',
            'order' => 'Order',
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
     * Gets query for [[Periode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriode()
    {
        return $this->hasOne(Periode::class, ['periode_id' => 'periode_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserFinance::class, ['user_id' => 'user_id']);
    }
}
