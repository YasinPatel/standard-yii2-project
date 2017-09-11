<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::className(),
                 'only' => ['myprofile','logout'],
                 'rules' => [
                     [
                         'actions' => ['myprofile','logout'],
                         'allow' => true,
                         'roles' => ['@'],
                           // 'matchCallback' => function ($rule, $action)
                           // {
                           //
                           // },
                     ],
                 ],
                 'denyCallback' => function ($rule, $action) {
                     return $this->redirect(Yii::$app->request->baseUrl);
                 }
             ],
         ];
     }
     public function actionError()
     {
          // $this->layout = 'frontweb/main-site';
          $exception = Yii::$app->errorHandler->exception;
          if ($exception !== null)
          {
            if($exception->statusCode==404) // load 404 page
            return $this->render('error_404');
          }

          // if(Yii::$app->user->identity->usertype == 'D')
          // {
          //     $flash_msg = \Yii::$app->params['msg_error'].' '.$exception->getMessage().\Yii::$app->params['msg_end'];
          //     \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
          // }elseif(Yii::$app->user->identity->usertype == 'A')
          // {
          //     $flash_msg = \Yii::$app->params['msg_error'].' '.$exception->getMessage().\Yii::$app->params['msg_end'];
          //     \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
          // }else{
          //     Yii::$app->user->logout(false);
          // }
          return $this->redirect(['index']);
     }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      // $this->layout=false;
        return $this->render('index');
    }

}
