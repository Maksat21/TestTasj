<?php

namespace app\entities;

use Yii;
use Exception;
use app\models\Courier;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\models\LogistShift;
use yii\web\IdentityInterface;
use app\helpers\LogistShiftHelper;

/**
 * User model
 *
 * @property integer $id
 * @property integer $role
 * @property string $phone
 * @property string $phone_verified
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $email_confirm_token
 * @property boolean $email_verified
 * @property string $auth_key
 * @property string $first_name
 * @property string $last_name
 * @property string $logo
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @property Token $tokens
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_BLOCKED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
            ->joinWith('tokens t')
            ->andWhere(['t.token' => $token])
            ->andWhere(['>', 't.expired_at', time()])
            ->one();
    }
    
    /**
     * @param $username
     * @return User|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param $password
     * @throws Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Remove
     */
    public function removeVerifiedToken()
    {
        $this->email_verified = true;
        $this->email_confirm_token = null;
    }

    /**
     * @return ActiveQuery
     */
    public function getTokens(): ActiveQuery
    {
        return $this->hasMany(Token::class, ['user_id' => 'id']);
    }
    
    
}
