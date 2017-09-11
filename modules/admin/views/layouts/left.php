<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
$dash = $user = $admin = '';

$controller = strtolower(Yii::$app->controller->id);
$action = strtolower(Yii::$app->controller->action->id);

function openness($controller)
{
    if(strtolower(Yii::$app->controller->id) == $controller)
    {
        return 'open active';
    }
}

function activeness($action)
{
    if(strtolower(Yii::$app->controller->id) == $action[0])
    {
        if(strtolower(Yii::$app->controller->action->id) == $action[1])
        {
            return 'active';
        }
    }
}
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>

      <li class="<?php echo openness('default'); ?>">
        <?= Html::a('<i class="fa fa-home"></i><span>Dashboard</span>',["/admin/default/index"]) ?>
      </li>
      <li class="<?php echo openness('user'); ?>">
        <?= Html::a('<i class="fa fa-users"></i><span>Users</span>',["/admin/user/index"]) ?>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
