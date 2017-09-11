<?php

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Admin');;
$base_url=Yii::$app->request->baseUrl;

$counts=Yii::$app->mycomponent->getDashboardCount();
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
         if(Yii::$app->session->hasFlash('flash_msg')){
           echo  Yii::$app->getSession()->getFlash('flash_msg');
     } ?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>0</h3>
              <p>Entrepreneur</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?=$base_url?>/admin/user/index?Usersearch%5Buser_type%5D=E" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>1</h3>

              <p>Investor</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?=$base_url?>/admin/user/index?Usersearch%5Buser_type%5D=I" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>1</h3>

              <p>Service Provider</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?=$base_url?>/admin/user/index?Usersearch%5Buser_type%5D=S" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>1</h3>

              <p>Mentor</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?=$base_url?>/admin/user/index?Usersearch%5Buser_type%5D=M" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
