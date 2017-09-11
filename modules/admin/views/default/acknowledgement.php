<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Yii::$app->params['apptitle'].' : Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<form id="login-form" class="form-signin" style="max-width: 530px;">
        <h2 class="form-signin-heading">
            <?= "Reset Password"; ?>
        </h2>
        <div class="login-wrap">
            <?php
            $a = \Yii::$app->getSession()->getFlash('flash_msg');

            if($a)
                echo $a;
            else
            {
                $msg = Yii::$app->params['error_forgot_password_link_expired'];
                echo \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
            }
            ?>
        </div>
</form>
<script>
    $(document).ready(function(){
        $('.alert-dismissable').removeClass('alert-dismissable');
        $('.fa-times').removeClass('fa-times');
    });
</script>
