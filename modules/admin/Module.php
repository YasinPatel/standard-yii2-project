<?php

namespace app\modules\admin;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
     public function init()
     {
         parent::init();

         \Yii::$app->errorHandler->errorAction = 'admin/default/error';

         \Yii::$app->set('user', [
             'class' => 'yii\web\User',
             'identityClass' => 'app\models\UserAdmin',
             'enableAutoLogin' => true,
             'loginUrl' => ['admin/default/login'],
             'identityCookie' => [
                 'name' => '_AdminUserstart', // unique for frontend
             ]
         ]);

         \Yii::$app->set('session', [
             'class' => 'yii\web\Session',
             'name' => '_adminSessionId',
             'savePath' => sys_get_temp_dir(),

         ]);
     }
}
