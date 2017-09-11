<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Import Users</h4>
            </div>
            <?php $form = ActiveForm::begin([
    						'id'=>'categoryForm',
    						'layout'=>'horizontal',
    						'action' => Yii::$app->request->baseUrl.'/admin/user/import',
    						'options' => ['class' => 'form-horizontal','enctype'=>'multipart/form-data'],
    						'fieldConfig' => [
    							//'template' => " <div class=\"control-group\">{lable}<div class=\"controls\">{input}</div>\n<div class=\"col-lg-7\">{error}</div></div>",
    							// 'enableClientValidation'=>true,
    							// 'enableAjaxValidation'=>true,
    							'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
    							'horizontalCssClasses' => [
    								'label' => 'col-sm-4',
    								'offset' => 'col-sm-offset-2',
    								'wrapper' => 'col-lg-6',
    								'error' => '',
    								'hint' => '',
    							],
    							//'template' => '{label} <div class="col-lg-6">{input}{error}</div>'
    							// 'inputOptions' => ['class' => 'm-wrap span6'],
    						],
    					]);
    				?>
    				<input type="hidden" id="cityid" value="">
    				<div class="modal-body">

              <div class="form-group last">
                <label class="control-label col-sm-2">Excel File</label>
                  <div class="col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                      <div>
                       <span class="btn btn-default btn-file">
                        <span class="fileupload-new">
                          <i class="fa fa-paper-clip"></i> Select file
                        </span>

                        <span class="fileupload-exists">
                          <i class="fa fa-undo"></i> Change
                        </span>
                        <input type="file" class="default" name="list[file]"/>
                      </span>
                                                  <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                              </div>

                      <span id="image-error"></span>
                                          </div>

                                      </div>
                                  </div>

    				</div>
    				<div class="modal-footer">
    					<button type="submit" class="btn btn-success submit"><?php echo Yii::t('app', 'Submit'); ?></button>
    					<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
    				</div>
    				<?php ActiveForm::end(); ?>


        </div>
    </div>
</div>

<script >
  jQuery.validator.addMethod("imagetype", function(value, element) {
  return this.optional(element) || /^.*\.(xls|xlsx)$/i.test(value);
    }, "Plese Select Excel File only");

	 var form1 = $('#categoryForm');
	var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);
        form1.validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: true, // do not focus the last invalid input
		          rules: {
                      "list[file]": {
                          required:true,
            							imagetype: true,

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
                    if (element.attr("name") == "list[file]") { // for uniform radio buttons, insert the after the given container
                        error.addClass("no-left-padding").insertAfter("#image-error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavoir
                    }
                },
	        });

 </script>
