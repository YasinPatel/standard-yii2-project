<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Yii::$app->params['apptitle'].' : Reset Passowrd';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box-body">
    <p class="login-box-msg">Reset Password</p>
    <?php
        echo \Yii::$app->getSession()->getFlash('flash_msg');
    ?>

        <?php $form = ActiveForm::begin([
            'id' => 'reset-form',
            'options' => ['class' => 'form-signin'],
        ]); ?>

        <?= $form->field($model, 'password',['inputOptions'=>array('placeholder'=>'New password','required'=>'required')])->passwordInput()->label(false); ?>
        <?= $form->field($model, 'PasswordConfirm',['inputOptions'=>array('placeholder'=>'Confirm new password','required'=>'required')])->passwordInput()->label(false); ?>
        <div class="row">
            <div class="col-xs-4">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-lg btn-login btn-block', 'name' => 'login-button']) ?>
            </div>
            <!--<button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>-->

        </div>
      <?php ActiveForm::end(); ?>

</div>
<script>
$( document ).ready(function() {
var form1 = $('#reset-form');
var error1 = $('.alert-danger', form1);
var success1 = $('.alert-success', form1);
form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        rules: {

            "Users[password]": {
                required: true,
                minlength:6,
                maxlength:15,
            },
            "Users[PasswordConfirm]": {
                required:true,
                equalTo: "#users-password",
                minlength:6,
                maxlength:15,
            },
        },

        invalidHandler: function (event, validator) { //display error alert on form submit
            success1.hide();
            error1.show();
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label
                .closest('.form-group').removeClass('has-error'); // set success class to the control group

        },
        errorPlacement: function (error, element) { // render error placement for each input type
            if (element.attr("name") == "User[image]") { // for uniform radio buttons, insert the after the given container
                error.addClass("no-left-padding").insertAfter("#image-error");
            }
            if (element.attr("name") == "User[coverimage]") { // for uniform radio buttons, insert the after the given container
                error.addClass("no-left-padding").insertAfter("#coverimage-error");
            }else {
                error.insertAfter(element); // for other inputs, just perform default behavoir
            }
        },

    });
});
</script>
