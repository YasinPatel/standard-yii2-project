<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = Yii::$app->params['apptitle'].' : Login To Your Account';



$cookies = Yii::$app->request->cookies;
$email_id = $cookies->getValue(Yii::$app->params['appcookiename'].'email_id');

//return default value if the cookie is not available
$password = $cookies->getValue(Yii::$app->params['appcookiename'].'password');
$no = $cookies->getValue(Yii::$app->params['appcookiename'].'turns');

for($i=1;$i<=$no;$i++){
	$email_id = base64_decode($email_id);
	$password = base64_decode($password);
}

if($email_id){$model->email_id = $email_id; $model->username=$email_id;}
if($password){$model->password = $password;}
if($email_id){$model->rememberMe = true;}

?>
<!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php
        echo \Yii::$app->getSession()->getFlash('flash_msg');
    ?>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-signin'],
    ]); ?>
      <?= $form->field($model, 'email_id',['inputOptions'=>array('placeholder'=>'Email Id')])->label(false); ?>
      <?= $form->field($model, 'password',['inputOptions'=>array('placeholder'=>'Password')])->passwordInput()->label(false); ?>
      <div class="row">
        <div class="col-xs-8">
          <?php echo $form->field($model, 'rememberMe', ['template' => '<label>{input}</label>'])->checkbox(); ?>
        </div>

        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    <?php ActiveForm::end(); ?>

        <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

    <!--<a href="#">I forgot my password</a><br>-->

  </div>
  <!-- /.login-box-body -->


   <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <!--form-->
                      <?php $form = ActiveForm::begin([
                            'id' => 'forgot-form',
                            'options' => ['class' => ''],
                            'action' => ['default/forgotpassword'],
                            'enableClientValidation' => true,
                            'validateOnSubmit' => true,
                            'enableAjaxValidation' => true,

                            //'fieldConfig' => [
                            //    //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            //    //'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            //],
                        ]); ?>

                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <!--<input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">-->
                            <?= $form->field($user1, 'email_id',['inputOptions'=>array('placeholder'=>'Email ID','autocomplete'=>"off",'class'=>"form-control placeholder-no-fix")])->label(false); ?>
                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <!--<button class="btn btn-success" type="button">Submit</button>-->
                          <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                      </div>
                      <?php ActiveForm::end(); ?>
                      <!--end form-->
                  </div>
              </div>
          </div>
          <!-- modal -->
<script>
 $(".checkbox").addClass("icheck");
</script>
