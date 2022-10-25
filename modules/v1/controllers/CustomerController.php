<?php

namespace app\modules\v1\controllers;

use app\components\MapDataProvider;
use app\helpers\OrderHelper;
use app\helpers\UserHelper;
use app\models\Book;
use app\modules\v1\forms\BookForm;
use app\modules\v1\models\search\BookSearch;
use app\modules\v1\models\search\OrderSearch;
use DomainException;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\rest\Serializer;
use yii\filters\AccessControl;

/**
 * Class CustomerController
 * @package app\modules\v1\controllers
 */
class CustomerController extends Controller
{
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items'
    ];

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
                    'roles' => [UserHelper::ROLE_CUSTOMER],
                ],
            ],
        ];

        return $behaviors;
    }
    

    public function actionSearch()
    {
        $searchModel = new BookSearch();
        $provider = $searchModel->search(Yii::$app->request->queryParams);
    
        return new MapDataProvider($provider, [$this, 'serailizeBookItem']);
    }
    
    /**
     * @param Book $item
     * @return array
     */
    public function serailizeBookItem(Book $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'genres' => $item->genres,
            'author_name' => $item->author->name,
            'country' => $item->author->country,
            'publication_date' => Yii::$app->formatter->asDatetime($item->publication_date)
        ];
    }
}
