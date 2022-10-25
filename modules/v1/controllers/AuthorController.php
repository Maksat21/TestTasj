<?php

namespace app\modules\v1\controllers;

use app\helpers\UserHelper;
use app\modules\v1\forms\AuthorForm;
use app\services\AuthorService;
use Exception;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\filters\AccessControl;

/**
 * Class AuthorController
 * @package app\modules\v1\controllers
 */
class AuthorController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [HttpBearerAuth::class];
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => [UserHelper::ROLE_ADMIN],
                ],
            ],
        ];

        return $behaviors;
    }
    
    /**
     * @return int[]
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        try {
            $form = new AuthorForm();
            $form->load(Yii::$app->request->getBodyParams(), '');
    
            (new AuthorService($form))->create();
            
            return [
                'status' => 200,
                'message' => 'Success'
            ];
            
        } catch (Exception $e){
            throw $e;
        }
    }
}
