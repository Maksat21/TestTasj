<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use app\modules\v1\forms\LoginForm;


class AuthController extends Controller
{
    /**
     * @return \app\entities\Token|LoginForm
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');

        if ($token = $model->auth()) {
            return $token;
        } else {
            return $model;
        }
    }
}
