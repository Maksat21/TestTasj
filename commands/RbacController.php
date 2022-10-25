<?php
namespace app\commands;

use app\helpers\UserHelper;
use Yii;
use yii\console\Controller;
use yii\rbac\PhpManager;

/**
 * Class RbacController
 * @package console\controllers
 */
class RbacController extends Controller
{
    /**
     * @return int|void
     * @throws \Exception
     */
    public function actionInit()
    {
        if (!$this->confirm("Are you sure? It will re-create permissions tree.")) {
            return self::EXIT_CODE_NORMAL;
        }
        
        /** @var $auth PhpManager */
        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();
    
        $admin = $auth->createRole(UserHelper::ROLE_ADMIN);
        $admin->description = 'Роль Администратор';
        $auth->add($admin);
        
        $customer = $auth->createRole(UserHelper::ROLE_CUSTOMER);
        $customer->description = 'Роль Клиент';
        $auth->add($customer);
        
        $this->stdout('Done!' . PHP_EOL);
    }
}
