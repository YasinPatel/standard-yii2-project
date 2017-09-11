<?php
use yii\helpers\Html;
use app\models\Eventparticipants;
use app\models\Users;

$this->title = Yii::t('app', 'User Details');
$this->params['breadcrumbs'][] = $this->title;

?>

<style media="screen">
  hr{
    margin-top: 5px !important;
    margin-bottom: 5px !important;
    border-top: 2px solid #eee !important;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <h1>
      <?php  echo Html::encode($this->title) ?>
      </h1>
     <ol class="breadcrumb">
       <li><?=Html::a('<i class="fa fa-dashboard"></i> '.Yii::t('app', 'Home'), ['site/index']) ?></li>
       <li class="active"><?=Html::a('Users', ['user/index']) ?></li>
       <li class="active">      <?php  echo Html::encode($this->title) ?></li>

     </ol>
   </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-primary">
      <div class="box-body box-profile">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th>
                    Name
                  </th>
                  <td>
                    <?=$model->user_name?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
