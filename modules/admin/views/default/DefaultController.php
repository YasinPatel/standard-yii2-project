<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\LoginFormAdmin;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use Exception;
/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index','update','change','view','page','active','logout','timezone'],
                'rules' => [
                    [
                        'actions' => ['index','logout','timezone'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action)
                        {
                          if(implode(',',Yii::$app->user->identity->user_type) == 'A' )
                            return true;
                          else {
                            // return $this->redirect('index');
                            return false;
                          }
                        },
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }
    public function actionError()
    {
        $this->layout = 'admin';
         $exception = Yii::$app->errorHandler->exception;
         if ($exception !== null)
         {
           if($exception->statusCode==404) {
             return $this->render('error_404');
           }
           else {
             return $this->render('error');
           }
         }
         return $this->redirect(['index']);
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $model = new LoginFormAdmin();
        $user = new Users();
        $user1 = new Users();

        if($model->load(Yii::$app->request->post()) && $model->login())
        {
            if(isset($_POST['LoginFormAdmin']['rememberMe']) && $_POST['LoginFormAdmin']['rememberMe'] =="1")
            {
                $cookies = Yii::$app->response->cookies;
                // add a new cookie to the response to be sent

                $no = rand(1,9);

                $v1 = $_POST['LoginFormAdmin']['email_id'];
                $v2 = $_POST['LoginFormAdmin']['password'];

                for($i=1;$i<=$no;$i++){
                    $v1 = base64_encode($v1);
                    $v2 = base64_encode($v2);
                }

                $cookies->add(new \yii\web\Cookie([
                    'name' => Yii::$app->params['appcookiename'].'email_id',
                    'value' => $v1,
                ]));

                $cookies->add(new \yii\web\Cookie([
                    'name' => Yii::$app->params['appcookiename'].'password',
                    'value' => $v2,
                ]));

                $cookies->add(new \yii\web\Cookie([
                    'name' => Yii::$app->params['appcookiename'].'turns',
                    'value' => $no,
                ]));

            }else{
                $cookies = Yii::$app->response->cookies;
                $cookies->remove(Yii::$app->params['appcookiename'].'email_id');
                unset($cookies[Yii::$app->params['appcookiename'].'email_id']);
                 $cookies->remove(Yii::$app->params['appcookiename'].'password');
                unset($cookies[Yii::$app->params['appcookiename'].'password']);
                $cookies->remove(Yii::$app->params['appcookiename'].'turns');
                unset($cookies[Yii::$app->params['appcookiename'].'turns']);

            }
            return $this->redirect(['index']);
            // return $this->goBack();
        } else {
            if($model->load(Yii::$app->request->post()))
            {
                $msg = "Email id or password is wrong";
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
            }
            return $this->render('login', [
                'model' => $model,
                'user'=>$user,
                'user1'=>$user1,
            ]);
        }
    }
    public function actionLogout()
    {
        Yii::$app->user->logout(false);

        return $this->redirect(['index']);
    }
    /*
     * Verify Email ID
     */
    public function actionEmailverification()
    {
        $this->layout = 'admin/emailverification';
        if(isset($_REQUEST['token']) && $_REQUEST['token'] != null)
        {
            $type = array('U');
            $token = $_REQUEST['token'];
            $findUser = Users::find()->where(['user_type'=>$type,'email_verification_token'=>$token])->one();
            if(isset($findUser))
            {
                if($findUser->email_verified == 'N'){
                    Yii::$app->db->createCommand()->update('user_master', [
                        'email_verified' => 'Y',
                        'i_date' => time(),
                        'u_date' => time()
                    ], 'id = '.$findUser->id)->execute();

                    $msg = "Your email is verified now.";
                    $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                  return $this->redirect('emailverified');
                }else{
                    $msg = "Email already verified.";
                    $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);

                    //return $this->redirect(['default/index/']);
                    return $this->redirect('emailverified');
                }
            }else{
                $msg = "Email verification token is not valid";
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);

                //return $this->redirect(['default/index/']);
                return $this->redirect('emailverified');
            }
        }else{
            $msg = "You don't have permission to access this page.";
            $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
            \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);

            return $this->redirect(['emailverified']);
        }
    }

    /*
     * Verify Email ID
     */
    public function actionAcknowledgement()
    {
        $this->layout = '/admin/login';
        return $this->render('acknowledgement');
    }


    /*
     * Reset password request
     */
    public function actionResetpassword()
    {
        if(isset($_REQUEST['args']) && $_REQUEST['args'] != null)
        {
            //echo $_REQUEST['args'];die;
            $data = Users::find()->where(['forgot_password_token'=>$_REQUEST['args'],'is_deleted'=>'N'])->one();
            if(!$data)
            {
               $msg = Yii::$app->params['error_forgot_password_link_expired'];
               $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
               \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
               return $this->redirect('acknowledgement');
            }

            $oldmodel = $data;
            $data->scenario='resetpassword';
            $data->password= "";

           if (Yii::$app->request->isAjax && $data->load(Yii::$app->request->post())) {
               echo  json_encode(ActiveForm::validate($data));
               die;
            }
            if($data)
            {
                if($data->forgot_password_token_timeout == '' || $data->forgot_password_token_timeout+(60*60) < time())
                {
                    $msg = Yii::$app->params['error_forgot_password_link_expired'];
                    $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                    return $this->redirect('acknowledgement');
                }
                else
                {

                    $this->layout='/admin/login';
                    //$data->scenario='resetpassword';
                    if(isset($_POST['Users']) && $_POST['Users']!=array())
                    {

                        if(isset($_POST['Users']['password'])&& $_POST['Users']['password']!=null)
                        {
                            $data->password=md5($_POST['Users']['password']);
                            //$data->PasswordConfirm=md5($_POST['User']['PasswordConfirm']);
                        }
                        else
                        {
                            $data->password=$oldmodel->password;
                        }
                         $data->forgot_password_token = null;
                         $data->forgot_password_token_timeout = null;
                         $data->u_date=time();
                       if($data->save(false))
                       {
                            //return $this->render('resetpassword',['model'=>$model]);
                            $msg = 'Password has been successfully changed.';
                            $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
                            \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                            return $this->redirect('acknowledgement');
                       }
                       else
                       {
                            $msg = 'Something went wrong please try again.';
                            $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                            \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                            return $this->render('acknowledgement');
                       }
                    }
                    else
                        return $this->render('resetpassword',['model'=>$data]);
                }
            }
            else
            {
                $msg = Yii::$app->params['error_forgot_password_link_expired'];
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                return $this->redirect('acknowledgement');
            }
        }
        else
        {
            $msg = 'No such data found.';
            $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
            \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
            return $this->redirect('acknowledgement');
        }
    }
    public function actionForgotpassword()
    {
        $this->layout = '/admin/login';
        $model = new Users();
        //echo "1";die;
        $model->scenario='forgotpassword';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            echo  json_encode(ActiveForm::validate($model));
            die;
        }

        if($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            $post = Users::find()->where(['email_id'=>$params['Users']['email_id'],'user_type'=>['A'],'is_deleted'=>'N'])->one();
            if(isset($post->id))
            {

                // set forgot password token, which will passed in url
                $random_str = time().rand(10000,99999);
                $post->forgot_password_token = md5($random_str);
                $post->forgot_password_token_timeout = time();

                if($post->save(false))
                {

                    $link=URL::to(["/admin/default/resetpassword","args"=>$post->forgot_password_token],true);
                    $subject=Yii::$app->params['apptitle'].' : Reset Password Request';
                    $user_name=$post->first_name;
                    $send_to=$params['Users']['email_id'];
                    Yii::$app->mycomponent->sendMail('forgot_password_admin',$subject,$send_to,$user_name,$link);

                    // Yii::$app->mailer->compose('@app/mail/layouts/forgotpasswordadmin', [
                    //         'username' => $post->first_name,
                    //         'link_token' => $post->forgot_password_token,
                    //         'link'=>URL::to(["/admin/default/resetpassword","args"=>$post->forgot_password_token],true),
                    // ])
                    // ->setTo($params['Users']['email_id'])
                    // ->setFrom(Yii::$app->params['adminEmail'])
                    // ->setSubject(Yii::$app->params['apptitle'].' : Reset Password Request')
                    // //->setTextBody("Your new Password is : ".$pass)
                    // ->send();

                    $msg = "Password has been sent to your email";
                    $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                }
                else
                {
                    //print_r($post->getErrors());die;
                    $msg = "Please try again";
                    $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                    //Yii::$app->getSession()->setFlash('error', 'Failed to send email');
                }
            }
            else
            {
                $msg = "No such email found";
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
            }
            return $this->redirect(['login']);
        }

        return $this->render('forgotpassword',[
                            'model' => $model
                            ]);
    }
    public function actionEmailverified()
    {
        $this->layout = '/admin/login';
        return $this->render('useremailverification');
    }
}
