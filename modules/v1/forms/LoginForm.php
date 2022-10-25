<?php

namespace app\modules\v1\forms;

use app\entities\Token;
use app\entities\User;
use app\helpers\UserHelper;
use yii\base\Model;

/**
 * Class LoginForm
 * @package api\modules\app\forms
 */
class LoginForm extends Model
{
    public string $username;
    public string $password;

    private $_user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
            ['password', 'validateStatus'],
            ['password', 'validateRole'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function validateStatus($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if ($user && $user->status == User::STATUS_INACTIVE) {
                $this->addError($attribute, 'Account not activated.');
            } elseif ($user && $user->status == User::STATUS_BLOCKED) {
                $this->addError($attribute, 'Account blocked.');
            }
        }
    }

    public function validateRole($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            $allowedRoles = [
                UserHelper::ROLE_ADMIN,
                UserHelper::ROLE_CUSTOMER,
            ];

            if ($user && !in_array($user->role, $allowedRoles)) {
                $this->addError($attribute, 'Access denied for your role.');
            }
        }
    }

    public function auth()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = $this->getUser();
        $token = new Token();
        $token->user_id = $this->getUser()->id;
        Token::deactivateAll($user->id);
        $token->generateToken(time() + 3600 * 24 * 30);

        return $token->save() ? $token : null;
    }

    /**
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}
