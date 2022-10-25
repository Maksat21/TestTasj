<?php

namespace app\modules\v1\controllers;

use app\helpers\UserHelper;
use app\modules\v1\forms\BookForm;
use app\services\BookService;
use Exception;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\filters\AccessControl;

/**
 * Class BookController
 * @package app\modules\v1\controllers
 */
class BookController extends Controller
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
            $form = new BookForm();
            $form->load(Yii::$app->request->getBodyParams(), '');
    
            (new BookService($form))->create();
            
            return [
                'status' => 200,
                'message' => 'Success'
            ];
            
        } catch (Exception $e){
            throw $e;
        }
    }
}
