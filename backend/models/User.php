<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_user".
 *
 * @property int $user_id
 * @property string|null $nik
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $active
 * @property string $no_hp
 * @property string $verf_code
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'active', 'no_hp', 'verf_code', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nik', 'no_hp'], 'string', 'max' => 16],
            [['username', 'password', 'email', 'verf_code'], 'string', 'max' => 128],
            [['created_by', 'updated_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'nik' => 'Nik',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'active' => 'Active',
            'no_hp' => 'No Hp',
            'verf_code' => 'Verf Code',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
