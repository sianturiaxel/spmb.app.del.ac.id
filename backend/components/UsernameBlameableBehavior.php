<?php

namespace backend\components;

use yii\behaviors\BlameableBehavior;
use Yii;

class UsernameBlameableBehavior extends BlameableBehavior
{
    protected function getValue($event)
    {
        // Ambil username pengguna yang login saat ini
        $users = Yii::$app->get('users', false);
        return $users && !$users->isGuest ? Yii::$app->users->identity->username : null;
    }
}
