<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord)
{
    $a="true";
}
else
{
    $a="false";
}
$arr=['1'=>'One','2'=>'Two','3'=>'three'];
?>
<script type="text/javascript" src="<?=Url::to('@web/plugins/ckeditor/ckeditor.js')?>"></script>
<script src="<?=Yii::$app->request->baseUrl?>/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="<?=Yii::$app->request->baseUrl?>/plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css">


<div class="content-wrapper">
    <section class="content-header">
    <h1>
      <?php if($model->isNewRecord) { echo Yii::t('app', 'Create'); } else{ echo Yii::t('app', 'Edit');} ?> Users
    </h1>
    <ol class="breadcrumb">
      <li><?=Html::a('<i class="fa fa-dashboard"></i> '.Yii::t('app', 'Home'), ['site/index']) ?></li>
      <li><?=Html::a('Users', ['user/index']) ?></li>
      <li class="active"><?php if($model->isNewRecord) { echo Yii::t('app', 'Create'); } else{ echo Yii::t('app', 'Edit');} ?></li>
    </ol>
  </section>
    <!-- Main content -->
	<section class="content">
        <div class="box box-primary">
          <div class="box-header with-border">
          </div>
    <?php $form = ActiveForm::begin(
    [
        'id'=>'users-form',
        'layout'=>'horizontal',
        'options' => ['class' => 'form-horizontal','enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]
    ); ?>
<div class="box-body">
    <div class="row">
        <div class="col-md-8 col-lg-6">
            <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email_id')->textInput(['maxlength' => true]) ?>
            <?php if($model->isNewRecord)
            {
              echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
            }
            ?>
            <div class="form-group field-event-image">
                <label class="control-label col-sm-4" for="event-image">Image<span class="required"> *</span></label>
                <div class="col-sm-8">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                            <?php  if(isset($model->image_path) && $model->image_path != '') { ?>
                            <img src="<?= Yii::$app->request->baseUrl."/".$model->image_path ?>" />
                            <?php } else { ?>
                            <img src="<?= Yii::$app->request->baseUrl?>/img/no-image.png" alt="" />
                            <?php } ?>
                        </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                        <div>
                         <span class="btn btn-default btn-file">
                         <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                         <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                         <input type="file" class="default" name="User[image]" />
                         </span>
                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload" id = "remove"><i class="fa fa-trash"></i> Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- addtional fields -->
    <hr/>
    <div class="row">
        <div class="col-md-8 col-lg-6">
          <!-- ckeditor -->
          <?= $form->field($model, 'temp1')->textarea(["rows"=>"10","cols"=>"80","class"=>"form-control "])->label('CK Editor') ?>
          <!-- date picker -->
          <div class="form-group">
              <label class="control-label col-sm-4" for="users-password">Date Picker</label>
              <div class="col-sm-8">
                <div class="input-group">
                    <input class="form-control txt_profile txt_dob" type="text" name="dob" value="" id="datepicker1">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
              </div>
          </div>
          <!-- time picker -->
          <div class="bootstrap-timepicker">
            <div class="form-group">
              <label class="control-label col-sm-4">Time Picker</label>
              <div class="col-md-8">
                <div class="input-group">
                  <input type="text" name="time" class="form-control timepicker">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- time picker -->
          <div class="bootstrap-datetimepicker">
            <div class="form-group">
              <label class="control-label col-sm-4">Date Time Picker</label>
              <div class="col-md-8">
                <div class="input-group">
                  <input type="text" name="time" class="form-control datetimepicker">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- radio list -->
          <?= $form->field($model, 'temp2')->radioList($arr)->label('Radio Buttons'); ?>
          <!-- Check box -->
          <?php echo $form->field($model, 'temp2[]')->checkboxList($arr)->label('Check Box'); ?>
          <!-- drop down list -->
          <?= $form->field($model, 'temp2')->dropDownList($arr)->label('List'); ?>
          <!-- select2 -->
          <?php  echo $form->field($model, 'temp3')->widget(Select2::classname(), [
                   'name'=>"temp3",
                   'id'=>'test',
                   'data' => $arr,
                   'options' => ['placeholder' => 'Select ...'],
                   'pluginOptions' => [
                       //'allowClear' => true
                          'tags' => false,
                           'allowClear' => true
                   ],
               ])->label('Select 2');
          ?>
          <!-- select2 multiple tags -->
          <div class="form-group">
              <label class="control-label col-sm-4" for="users-password">Select( tags )</label>
              <div class="col-sm-8">
                <?php
                  echo Select2::widget([
                      'name' => 'temp4',
                      'id' => 'temp4',
                      'value' => '',
                      'data' => $arr,
                      'options' => [
                          'multiple' => true,
                          'placeholder' => 'Select'],
                          'pluginOptions' => [
                            'tags' => true,
                            'allowClear' => true,
                            'tokenSeparators' => [',', ' '],
                             ] ,
                     ]);
               ?>
              </div>
          </div>
          <!-- multi select -->
          <div class="form-group">
            <label class="control-label col-sm-4" > Select (multiple)</label>
            <div class="col-sm-8">
              <?= Html::dropDownList('temp4', null,$arr,['class' => 'form-control platformList',"multiple" => 'multiple','id'=>'platformList']) ?>
            </div>
          </div>

        </div>
    </div>
    <!-- end addtional fields -->
</div>
<div class="box-footer">
    <div class="row">
        <div class="col-md-8 col-lg-6">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-4">
                    <?=  Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' =>'btn btn-primary load-button']) ?>
					<?=  Html::a(Yii::t('app', 'Cancel'),['user/index'],['class'=>"btn btn-default"]); ?>

                </div>
            </div>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>


<script >
	  jQuery.validator.addMethod("imagetype", function(value, element) {
	   return this.optional(element) || /^.*\.(jpg|png|jpeg)$/i.test(value);
    }, "Please Select .jpg .png or .jpeg Image");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Special char and digits are not allowed");

    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "Spaces are not allowed");

	var form1 = $('#users-form');
	var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);
        form1.validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: true, // do not focus the last invalid input
              ignore:[],
		          rules: {
                      "Users[user_name]": {
                          required:true,
                          minlength:3,
                          maxlength:50,
                          // lettersonly:true,
                      },
                      "Users[email_id]": {
                          required:true,
                          email:true
                          // maxlength:255,
                      },
                      "Users[password]": {
                          required:true,
                          minlength:6,
                          maxlength:20,
                      },
            				  "User[image]": {
            							imagetype: true,
                          required:<?=$a?>
            				 	},
                      "Users[temp1]": {
                          required:true,
                      },
				            },
                messages: {
                    //  "Event[event_name]": {
                    //    required: "Enter Event Name",
                    //    minlength: "Event Name must have at least 3 characters",
                    //    maxlength: "Event Name must have maximum 50 characters",
                    //  },
                    //  "Event[description]": {
                    //    required: "Enter Event description",
                    //    minlength: "Event description must have at least 7 characters",
                    //  },
                 },
                //  submitHandler: function(form) {
                //
                 //
                //   },
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
                errorPlacement: function(error, element) {
                  if (element.attr("name") == "Users[temp1]") { // for uniform radio buttons, insert the after the given container
                      error.insertAfter("#cke_users-temp1");
                  }
                  else {
                      error.insertAfter(element); // for other inputs, just perform default behavoir
                  }
                },
	        });

 </script>

 <script>
  CKEDITOR.replace('users-temp1');
    var d = new Date();
    $("#datepicker1").datepicker({
      autoclose:true,
      format:'dd-mm-yyyy',
      endDate: '+0d',
      endDate: new Date(d.setDate(d.getDate() - 1))
      // startDate:'+1d'
    });

    $(".timepicker").timepicker({
      showInputs: false
    });
 </script>

<script>
$(document).ready(function() {
  $('.platformList').multiselect();
 });
 $('.datetimepicker').datetimepicker();

</script>
