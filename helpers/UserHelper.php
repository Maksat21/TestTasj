<?php

namespace app\helpers;

use Yii;
use yii\web\IdentityInterface;

/**
 * Class UserHelper
 * @package app\helpers
 */
class UserHelper
{
    /** Roles */
    const ROLE_ADMIN = 1;
    const ROLE_CUSTOMER = 2;
    
    /**
     * @return \app\models\User|IdentityInterface|null
     */
    public static function getIdentity()
    {
        return Yii::$app->user->identity;
    }
}
