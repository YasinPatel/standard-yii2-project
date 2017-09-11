<?php
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<style media="screen">
.spin-full-loader{
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}
.spin-full-loader > img{
  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  margin: -30px auto 0;

}
.spin-full-loader > p{
  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  margin: 0px auto 0;
  text-align: center;
  color: #fff;;
}
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->beginBody() ?>
    <?php include_once('top_header.php');?>
    <?php include_once('left.php');?>
    <!--<div class="content-wrapper">-->
    <?= $content?>
    <!--</div>-->
    <?php //include_once('footer.php');?>

<?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>
<script>
     setTimeout(function(){
         $('.alert-dismissable').slideUp();
     },5000);
</script>
