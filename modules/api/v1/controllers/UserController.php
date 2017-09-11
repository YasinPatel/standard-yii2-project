<?php

namespace app\modules\api\v1\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Users;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\Users';

    public function behaviors()
    {
        $behaviors[] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        $behaviors['authenticator'] = [
            'except' => ['login','register','forgotpassword','sociallogin','resetpassword','updatepassword','resendotp','verifyotp','cmspages','test'],
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    // api to login user
    public function actionLogin()
    {
      if(
        isset($_POST['password']) && $_POST['password'] != null &&
        isset($_POST['email_id']) && $_POST['email_id'] != null &&
        isset($_POST['device_type']) && $_POST['device_type'] != null &&
        isset($_POST['device_id']) && $_POST['device_id'] != null
        )
        {
          $data = Users::find()->where(['is_deleted'=>'N','email_id'=>$_POST['email_id'],'user_type'=>'U'])->one();

          if(!$data)
          {
            $result['code'] = 400;
            $result['message'] = Yii::t('app',Yii::$app->params['invalid_login_email']);
            Yii::$app->getResponse()->setStatusCode(400);
            return $result;
          }
          if($data->is_active == 'N')
          {
            $result['code'] = 400;
            $result['message'] = Yii::t('app',Yii::$app->params['account_deactivated']);
            Yii::$app->getResponse()->setStatusCode(400);
            return $result;
          }
          if(md5($_POST['password']) != $data->password )
          {
            $result['code'] = 400;
            $result['message'] = Yii::t('app',Yii::$app->params['invalid_login_1']);
            Yii::$app->getResponse()->setStatusCode(400);
            return $result;
          }

          if(isset($_POST['device_id']))
              $data->device_id = $_POST['device_id'];

          if(isset($_POST['device_type']))
              $data->device_type = $_POST['device_type'];

          $data->access_token = \Yii::$app->security->generateRandomString();

          if($data->save(false))
          {
            Yii::$app->getResponse()->setStatusCode(200);
            // $result = Yii::$app->mycomponent->userResponse($data);
            $result['code'] = 200;
            $result['message'] = Yii::t('app',Yii::$app->params['success']);
            return $result;
          }
          else {
            $result['code'] = 404;
            $result['message'] = Yii::t('app',Yii::$app->params['error_in_save']);
            Yii::$app->getResponse()->setStatusCode(404);
            return $result;
          }
        }
        else {
          $result['code'] = 400;
          $result['message'] = Yii::t('app',Yii::$app->params['response_text'][400]);
          Yii::$app->getResponse()->setStatusCode(400);
          return $result;
        }
    }
    // api to login user
    public function actionTest()
    {
      // $offset = (isset($_GET['offset']) && $_GET['offset'] != null)?$_GET['offset']:0;
      // $limit = (isset($_GET['limit']) && $_GET['limit'] != null)? $_GET['limit']:10;
      //
      // $result['is_last'] = "Y";
      // if( $i > $limit){
      //     unset($result["doctor_list"][ $i-1]);
      //     $result['is_last'] = "N";
      // }
      //
      // $result['code'] = 200;
      // $result['message'] = Yii::t('app',Yii::$app->params['success']);
      // return $result;
    }


}
