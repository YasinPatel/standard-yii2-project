<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usersearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
  <div class="col-md-2">
    <label>
    <?php
          $opt1 =['1'=>'1','5'=>'5','10'=>'10','20'=>'20','30'=>'30','50'=>'50','100'=>'100']; //Yii::$app->common->paginationarray();
          $size=\Yii::$app->session->get('user.size');
          if(isset($size) && $size!=null)
          $searchModel->id=\Yii::$app->session->get('user.size');
          else
          $searchModel->id=5;
          echo Html::activeDropDownList($searchModel,'id',$opt1,
              array('class'=>'tbl_top_link','onchange'=>'dopagination(this.value);','value'=>5,'label'=>false,'class'=>'m-wrap x-small va form-control','div'=>false)
          );
      ?>
    </label>
    <?php echo Html::a(Yii::t('app', 'Delete All').'<i class="icon-trash"></i>',"javascript:void(0);",["class"=>"btn btn-danger btn-sm",'data-placement'=>'bottom','title'=>'Delete All Categories ','style'=>'margin-bottom:3px', "id" => "delete", "escape" => false, "onclick" => "submitForm();if(this.href=='javascript:void(0);') { alert('Please Select At least One Record');} else { if(!confirm('Are you sure want to delete this data?')) return false;}"]); ?>&nbsp&nbsp

  </div>
  <div class="col-md-7">
    <?= Html::a('Add User', ['create'], ['class' => 'btn btn-primary']) ?>
    <a href="<?=\Yii::$app->request->baseUrl?>/admin/user/exportpdf" class="btn btn-default" style="margin-left: 10px;">Export Pdf</a>
    <a href="<?=\Yii::$app->request->baseUrl?>/admin/user/exportexcel" class="btn btn-default" style="margin-left: 10px;">Export Excel</a>
    <button type="button"  style='margin-left:10px' class="btn btn-default import-form"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;Import</button>
    <a href="<?=Yii::$app->request->baseUrl?>/sample/sample-cities.xls" download class="btn btn-default" style="margin-left:10px;">Sample Excel</a>
  </div>
  <div class="col-md-3">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="input-group">
        <?= $form->field($searchModel, 'search_var',['template' => '{input}'])->textInput(['placeholder'=>'Search','class'=>'form-control','autofocus'=>true])->label(false); ?>
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit" value="Search"><i class="fa fa-search"></i></button>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
  </div>
</div>
