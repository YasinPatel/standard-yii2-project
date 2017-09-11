<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Yii::t('app', 'Change Password');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-wrapper">
    <section class="content-header">
    <h1>Change Password
    </h1>
    <ol class="breadcrumb">
      <li><?=Html::a('<i class="fa fa-dashboard"></i> '.Yii::t('app', 'Home'), ['site/index']) ?></li>
      <li><?=Html::a('Users', ['user/index']) ?></li>
    </ol>
  </section>
    <!-- Main content -->
	<section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <!-- <h2 class="box-title">Change Password</h2> -->
            </div>
    <?php $form = ActiveForm::begin(
    [
        'id'=>'user-form',
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
              <?= $form->field($model, 'oldPassword')->passwordInput(['maxlength' => true])->label('Old Password') ?>
              <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Password') ?>
              <?= $form->field($model, 'PasswordConfirm')->passwordInput(['maxlength' => true])->label('Confirm Password') ?>

            </div>
        </div>
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
