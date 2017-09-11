<?php
use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Contact;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Userearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<script>
//function for change pagination
function dopagination(record)
{
   if(record != '')
   {
 $.ajax({
 type:"GET",
 url:"page",
 data:{size:record},    // multiple data sent using ajax
           success: function (result) {
               $.pjax.reload({container: '#w0-pjax', timeout: 2000});
           }
 });
   }
}
$('body').on('click','.reload',function(){
   $.pjax.reload({container: '#w0-pjax'});
});
/*
*for change status active/deactive
*/
function state(id,field,action)
{
   var id1= id;
   var val1 = field;
       $.ajax({
       type:"GET",
       url:"active",
       data:{id:id1,val:val1},    // multiple data sent using ajax
           success: function (result) {
               $.pjax.reload({container: '#w0-pjax', timeout: 2000});
           }
       });
}

$('body').on('click','input[type="checkbox"]',function(){
       if($(this).hasClass('select-on-check-all'))
       {
               //console.log(2);
               if ($(this).is(":checked")) {
                       $('input[type="checkbox"]').each(function(){
                           $(this).closest('span').addClass('checked');
                       });
               }
               else{
                       $('input[type="checkbox"]').each(function(){
                           $(this).closest('span').removeClass('checked');
                       });
               }
       }
       else{
               var chkcount = 0;
               var totalcount = 0;
               $('input[type="checkbox"]').each(function(){

                       totalcount++;
                       if($(this).attr("class") != "select-on-check-all"){

                               if($(this).is(":checked"))
                               chkcount ++;
                       }

               });
               if (totalcount-1==chkcount) {
                       $('.select-on-check-all').closest('th').find('div span').addClass('checked');
                       $('.select-on-check-all').prop('checked', true);
               }
               else{
                       $('.select-on-check-all').closest('th').find('div span').removeClass('checked');
                       $('.select-on-check-all').prop('checked', false);
               }
       }
});


/*function for activate,deactivate,delete all the selected recoreds*/
function submitForm()
{
   var strvalue = "";
   $('input[name="selection[]"]:checked').each(function() {
       if(strvalue!="")
           strvalue = strvalue + ","+this.value;
       else
           strvalue = this.value;
   });

   if(strvalue!="")
   {
       document.getElementById('delete').href = '<?php echo Yii::$app->request->baseUrl;?>/admin/user/change?str='+strvalue+'&&field=is_deleted&&val=Y';
   }
   else
   {
      document.getElementById('delete').href = 'javascript:void(0);';
   }

}
//for delete signle user
function del(id,field)
{
   var a=confirm("Are you sure want to delete this data?");
   if (a) {
           var id1 = id;
           var field1 =field;
           $.ajax({type: "GET",
           url: "delete",
           data: { id:id1},
           success:function(result){
           $.pjax.reload({container: '#w0-pjax'});//, timeout: 2000
         }
        });
   }
}
</script>
<div class="content-wrapper">

 <section class="content-header">
    <h1>
     <?php  echo Html::encode($this->title) ?>  </h1>
    <ol class="breadcrumb">
      <li><?=Html::a('<i class="fa fa-dashboard"></i> '.Yii::t('app', 'Home'), ['default/index']) ?></li>
      <li class="active"><?=Html::a('Users', ['user/index']) ?></li>
      <li class="#">List</li>

    </ol>
  </section>

      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
          			 <?php
	                  if(Yii::$app->session->hasFlash('flash_msg')){
                      echo  Yii::$app->getSession()->getFlash('flash_msg');
                } ?>
                <?php echo $this->render('_search', ['searchModel' => $searchModel]); ?>

              </div>
              <!-- /.box-header -->
              <div class="box-body">
             <?php \yii\widgets\Pjax::begin(['linkSelector'=>'','id'=>'w0-pjax']); ?>
                       <?=
                       //$layout = '<div class="btn-group pull-right">{toolbar}</div><div class="clearfix"></div>{items}{pager}';

                       GridView::widget([
          			            'dataProvider' => $dataProvider,
                       'summary' => false,
                       'pjax'=>true,
                       	'toolbar'=>[
                       	],

                       		'captionOptions'=>['title'=>'Post List'],

                       		'columns' => [
                       				[
                       				'class' => '\kartik\grid\CheckboxColumn',
                       				'width'=>'5%',
                       				],
                              [
                              'width'=>'10%',
                              'attribute'=>'user_name',
                              'class' => '\kartik\grid\DataColumn',
                              'headerOptions' => ['style' => 'text-align:center'],
                              //'pageSummary' => false,
                              'filter'=>true,
                              ],

                              [
                              'width'=>'10%',
                              'attribute'=>'email_id',
                              'class' => '\kartik\grid\DataColumn',
                              'headerOptions' => ['style' => 'text-align:center'],
                              //'pageSummary' => false,
                              'filter'=>true,
                              ],
                              [
                                 'options'=>['class'=>'skip-export'],
                                 'attribute' => 'is_active',
                                  'width'=>'5%',
                                  'label'=>'Status',
                                 'contentOptions' => ['style' => 'text-align:center'],
                                 'headerOptions' => ['style' => 'text-align:center'],
                                 'format' => 'raw',
                                 'filter'=>['Y'=>Yii::t('app', 'Active'),'N'=>Yii::t('app', 'Blocked')],
                                 'value' => function($data)
                                  {
                                 if($data->is_active=="Y")
                                  $btn='<a class="label label-success"  id="'.$data->id.'" field="N" onclick="state('.$data->id.',\'N\''.')">Active</a>';
                                 else if($data->is_active=="N")
                                  $btn='<a class="label label-danger" id="'.$data->id.'" field="Y" onclick="state('.$data->id.',\'Y\''.')">Blocked</a>';
                                  return $btn;
                                    },
                                  ],
              				            ['class' => '\kartik\grid\ActionColumn',
              				            'width'=>'10%',
              				            'template' => '{view}&nbsp;{update}&nbsp;{delete}', //{view}&nbsp view page is ready only use it
              				            'buttons' => [
                                                  'view' => function ($url, $model)
                                                  {
                                                      return Html::a('<button class="btn btn-default btn-sm btn-icon-only ajaxupdate"><i class="fa fa-eye"></i></button>', $url, [
                                                          'title' => Yii::t('app', 'View'),'data-pjax' => true
                                                      ]);
                                                  },
                                                  'update' => function ($url, $model)
                                                  {
                                                      return Html::a('<label class="btn btn-default btn-sm btn-icon-only ajaxupdate"><i class="fa fa-pencil"></i></label>', $url, [
                                                      'title' => Yii::t('app', 'update'),'data-pjax' => true
                                                      ]);
                                                  },
                                                  'delete' => function ($url, $model)
                                                  {
                                                  return '<button class="btn btn-default btn-sm btn-icon-only delete" id="'.$model['id'].'" field="Y" onclick="del('.$model['id'].',\'Y\''.')"><i class="fa fa-trash-o"></i></button>';

                                                  }
                                          ],

                                          'urlCreator' => function ($action, $model, $key, $index) {

              	                            if ($action === 'view') {
              	                            	$url =Yii::$app->request->baseUrl.'/admin/user/view?id='.$model['id'];
              	                            	return $url;
              	                            }
              	                             if ($action === 'update') {
              	                            	$url = Yii::$app->request->baseUrl.'/admin/user/update?id='.$model['id'];
              	                            	return $url;
              	                            }
              	                            if ($action === 'delete') {
              	                            	$url ='/index.php?r=admin/user/delete&id='.$model['id'];
              	                            	return $url;
              	                            }
                                          }

                                   	],
  				    ],
      ]); ?>
      <?php \yii\widgets\Pjax::end(); ?>

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
   	</section>

  </div>
  <div id="form_data"></div>

  <script>
  $('body').on('click', '.import-form', function(e){
    $('#form_data').html("");
    $.ajax({
        type:'GET',
        url:'<?=Yii::$app->request->baseUrl?>/admin/user/importform',
        success: function(response){
            $('#form_data').html(response);
            setTimeout(function(){ $('#myModal').modal('show'); }, 400);
        },
        error: function(response){
          toastr.error('Something went wrong');
        }
        });
    });
  </script>
