<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use backend\components\RbacHelper;

/**
 * Users model
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        return RbacHelper::isUserAdmin($this->id);
    }
    public function isKaprodi()
    {
        return RbacHelper::isUserAdmin($this->id);
    }
    public function isPanitia()
    {
        return RbacHelper::isUserAdmin($this->id);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }


    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    // public function getRoles()
    // {
    //     return $this->hasMany(Role::class, ['id' => 'role_id'])->viaTable('user_role', ['user_id' => 'id']);
    // }
    public function getRoles()
    {
        return $this->hasMany(Role::className(), ['id' => 'role_id'])
            ->viaTable('user_role', ['user_id' => 'id']);
    }
}
