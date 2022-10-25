<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "{{%token}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property integer $expired_at
 *
 * @property User $user
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%token}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'token', 'expired_at'], 'required'],
            [['user_id', 'expired_at'], 'integer'],
            [['token'], 'string', 'max' => 255],
            [['token'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function generateToken($expire)
    {
        $this->expired_at = $expire;
        $this->token = Yii::$app->security->generateRandomString();
    }

    public function fields()
    {
        return [
            'token' => 'token',
            'expired' => function () {
                return date(DATE_RFC3339, $this->expired_at);
            },
            'expired_at' => 'expired_at'
        ];
    }

    /**
     * @param $userId
     */
    public static function deactivateAll($userId)
    {
        static::deleteAll(['user_id' => $userId]);
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getExpiredDateTime()
    {
        return Yii::$app->formatter->asDatetime($this->expired_at);
    }
}
