<?php

namespace backend\components;

use backend\models\UserRole;
use Yii;

class RbacHelper
{
    public static function isUserAdmin($userId)
    {
        $userRole = UserRole::findOne(['user_id' => $userId]);
        return $userRole && $userRole->role->name === 'Admin';
    }
    public static function isUserKaprodi($userId)
    {
        $userRole = UserRole::findOne(['user_id' => $userId]);
        return $userRole && $userRole->role->name === 'Kaprodi';
    }
    public static function isUserPanitia($userId)
    {
        $userRole = UserRole::findOne(['user_id' => $userId]);
        return $userRole && $userRole->role->name === 'Panitia';
    }
}
