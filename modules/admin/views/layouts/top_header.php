<?php

use yii\helpers\Html;

use app\models\Adminnotification;

$base_url=Yii::$app->request->baseUrl;

?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?=$base_url?>/admin/default/index" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SG</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?=Yii::$app->params['appName']?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
            <a href="<?=$base_url?>/admin/notification/index" class="dropdown-toggle">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">0</span>
            </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png" class="user-image" alt="">
              <span class="hidden-xs">
                <?php
                  if(isset(Yii::$app->user->identity->user_name) && Yii::$app->user->identity->user_name!=null)
                  {
                    echo Yii::$app->user->identity->user_name;
                  }
                  else {
                    echo "Admin";
                  }
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png" class="img-circle" alt="User Image">
                <p>
                  <?php
                    if(isset(Yii::$app->user->identity->user_name) && Yii::$app->user->identity->user_name!=null)
                    {
                      echo  Yii::$app->user->identity->user_name;
                    }
                    else {
                      echo "Admin";
                    }
                  ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <?php echo Html::a('<span>Change Password</span>',["/admin/user/changepassword"],['class'=>'btn btn-default btn-flat']); ?>
                  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                </div>

                <div class="pull-right">
                   <?= Html::a('<span>Sign Out</span>',["/admin/default/logout"],['class'=>'btn btn-default btn-flat']) ?>
                  <!--<a href="#" class="btn btn-default btn-flat">Sign out</a>-->
                </div>

              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>

<style>
.user-footer .btn{ padding : 6px 9px !important; }
</style>
