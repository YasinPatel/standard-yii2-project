<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Users;
use app\models\Usersearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Dompdf\Dompdf;
use Dompdf\Options;
include_once(Yii::getAlias('@vendor').'/dompdf/autoload.inc.php');
/**
 * UserController implements the CRUD actions for Users model.
 */
class UserController extends Controller
{
    public $layout="admin";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index','update','change','view','page','active'],
                'rules' => [
                    [
                        'actions' => ['create','index','update','change','view','page','active'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Usersearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()))
        {
            if(isset($_FILES['User']['name']['image']) && $_FILES['User']['name']['image'] != null)
            {
                if($model->image_path != '' && $model->image_path != null && file_exists(Yii::getAlias('@webroot').'/'.$model->image_path))
                {
                    unlink(Yii::getAlias('@webroot')."/".$model->image_path);
                }
                $new_image['name'] = $_FILES['User']['name']['image'];
                $new_image['type'] = $_FILES['User']['type']['image'];
                $new_image['tmp_name'] = $_FILES['User']['tmp_name']['image'];
                $new_image['error'] = $_FILES['User']['error']['image'];
                $new_image['size'] = $_FILES['User']['size']['image'];

                $name = Yii::$app->common->normalUpload($new_image, Yii::$app->params['userimage']);
                $model->image_path = $name;
            }
            $model->password =md5($model->password);
            $model->i_by = Yii::$app->user->id;
            $model->i_date = time();
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();

            if($model->save(false))
            {
                $msg="User has been successfully added";
                $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldmodel = $this->findModel($id);
        $model->password='';
        if ($model->load(Yii::$app->request->post()))
        {
            if(isset($_FILES['User']['name']['image']) && $_FILES['User']['name']['image'] != null)
            {
                if($oldmodel->image_path != '' && $oldmodel->image_path != null && file_exists(Yii::getAlias('@webroot').'/'.$oldmodel->image_path))
                {
                    unlink(Yii::getAlias('@webroot')."/".$oldmodel->image_path);
                }
                $new_image['name'] = $_FILES['User']['name']['image'];
                $new_image['type'] = $_FILES['User']['type']['image'];
                $new_image['tmp_name'] = $_FILES['User']['tmp_name']['image'];
                $new_image['error'] = $_FILES['User']['error']['image'];
                $new_image['size'] = $_FILES['User']['size']['image'];

                $name = Yii::$app->common->normalUpload($new_image, Yii::$app->params['userimage']);
                $model->image_path = $name;
            }
            if(isset($model->password) && $model->password!=null)
            {
              $model->password=md5($model->password);
            }
            else {
              $model->password=$oldmodel->password;
            }
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();
            if($model->save()){
              $msg="User has been successfully updated";
              $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
              \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                return $this->redirect(['index']);
            }
            else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(isset($_REQUEST['id']))
        {
            $model = $this->findModel($_REQUEST['id']);
            $model->is_deleted = "Y";
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();
            $model->save(false);
        }
        //$this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPage()
    {
        if(isset($_REQUEST['size']) && $_REQUEST['size']!=null)
        {
            \Yii::$app->session->set('user.size',$_REQUEST['size']);
        }
    }
    public function actionChangepassword()
    {
      $model=Users::findOne(Yii::$app->user->id);
      $model->scenario = "changepassword";

      $oldmodel=Users::findOne(Yii::$app->user->id);
      $model->password='';
      if ($model->load(Yii::$app->request->post()))
      {
          if($model->validate())
          {
              if(isset($_REQUEST['Users']['password']) && $_REQUEST['Users']['password']!=null)
              {
                $model->password=md5($_REQUEST['Users']['password']);
              }
               $model->u_by = Yii::$app->user->id;
               $model->u_date = time();
              if($model->save(false))
              {
                return $this->redirect(['default/index']);
              }
              else {
                return $this->render('changepassword',['model'=>$model]);
              }
          }
          else {
            return $this->render('changepassword',['model'=>$model]);
          }

      }
      else {

        return $this->render('changepassword',['model'=>$model]);
      }
    }
    public function actionActive()
   {
       if(isset($_REQUEST['id']))
       {
           $model = $this->findModel($_REQUEST['id']);
           $model->is_active = $_REQUEST['val'];
           $model->u_by = Yii::$app->user->id;
           $model->u_date = time();
           $model->save(false);
       }
   }
   public function actionChange()
   {
       $str = $_REQUEST['str'];
       $field =$_REQUEST['field'];
       $val = $_REQUEST['val'];

       if($str!= null)
       {
           $cond = [$field => $val];

           if(Users::updateAll($cond,'id IN('.$str.')'))
           {
               if($_REQUEST['field'] == 'is_deleted')
               {
                   $msg = 'Data successfully deleted';
               }
               else{
                   $msg = 'Data successfully updated';
               }
               $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
               \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);

           }
           else
           {
               if($_REQUEST['field'] == 'is_deleted')
                   $msg = 'Unable to delete data. Please try again.';
               else
                   $msg = 'Unable to update data. Please try again.';

               $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
               \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
           }
       }
       //print_r($ct); die;
       $this->redirect(['index']);
   }

   public function actionExportexcel()
   {
     $data=Users::find()->where(['is_deleted'=>'N','user_type'=>'U'])->all();

     include Yii::getAlias('@vendor').'/PHPExcel/Classes/PHPExcel/IOFactory.php';
     include Yii::getAlias('@vendor').'/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

     $filename='user_report-'.date('_d-m-Y').'.xls';
     $lastCol='B';
     $objPHPExcel = new \PHPExcel();

     $objSheet = $objPHPExcel->getActiveSheet();
     $objSheet->setTitle('user_report');
     $objSheet->getStyle('A1:'.$lastCol.'1')->getFont()->setBold(true)->setSize(12);

     $objPHPExcel->setActiveSheetIndex(0);

     $rowCount = 1;
     $objPHPExcel->getActiveSheet()->getDefaultRowDimension(1)->setRowHeight(25);
     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
     $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,'User Report');
     $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowCount.':'.$lastCol.$rowCount);
     $objSheet->getStyle('A'.($rowCount))->getFont()->setBold(true);
     $rowCount++;

     $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,'User Name');
     $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,'Email');
     $objSheet->getStyle('A'.$rowCount.':'.$lastCol.$rowCount)->getFont()->setBold(true);

     $rowCount++;

     if(isset($data) && $data!=null)
     {
       foreach ($data as $list)
       {
         $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,ucfirst($list['user_name']));
         $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,ucfirst($list['email_id']));
         $rowCount++;
       }
     }

     $objSheet->getStyle('A1:'.$lastCol.($rowCount-1))->applyFromArray(
               array('borders' => array('allborders' => array('style' => \PHPExcel_Style_Border::BORDER_THIN,
                 'color' => array('rgb' => '000')))));

     $objSheet->getStyle('A1:'.$lastCol.$rowCount)->getAlignment()->applyFromArray(
             array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
     );
     $objPHPExcel->getActiveSheet()
       ->getStyle('A2:'.$lastCol.$rowCount)
       ->getAlignment()
       ->setWrapText(true);
      header('Content-type: application/vnd.ms-excel');
      header('Content-Disposition: attachment; filename="'.$filename.'"');
      header('Cache-Control: max-age=0');
      // header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
      header ('Cache-Control: cache, must-revalidate');
      header ('Pragma: public');
     $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

     $objWriter->save('php://output');
     exit;
   }
   public function actionImportform()
   {
       if(!Yii::$app->request->isAjax)
           throw new NotFoundHttpException('The requested page does not exist.');

       $str = $this->renderPartial('import');
       echo $str;
       die;
   }
   public function actionImport()
   {
     return $this->redirect(['index']);

       if(isset($_FILES['list']['name']) && $_FILES['list']['name']!=null)
       {
           ini_set('max_execution_time', -1);
           ini_set('memory_limit', '2048M');

           require Yii::getAlias('@vendor').'/PHPExcel/Classes/PHPExcel.php';

           $file = $_FILES['list']['tmp_name']['file'];
           $objPHPExcel = \PHPExcel_IOFactory::load($file);
           $sheetData = $objPHPExcel->getActiveSheet()->toArray(false,false,true,true);

           $i=0;$state=0;
           foreach($sheetData as $s)
           {
               if($i > 0) //for first line in excel
               {
                   if($s['B']!='')
                   {
                     $data=Users::find()->where(['is_deleted'=>'N'])->andWhere(['email_id'=>$s['B']])->one();
                     if(!$data)
                     {
                      //  $model = new State();
                      //  $model->state_name=$s['B'];
                      //  $model->i_by = Yii::$app->user->id;
                      //  $model->i_date = time();
                      //  $model->u_by = Yii::$app->user->id;
                      //  $model->u_date = time();
                      //  $model->save(false);
                      //  $state++;
                     }
                   }
               }
               $i++;
           }
           if($state>0)
           {
             $msg = Yii::$app->params['msg_success'].'Data has been Imported successfully.'.Yii::$app->params['msg_end'];
             Yii::$app->getSession()->setFlash('flash_msg', $msg);
           }
           else
           {
             $msg = Yii::$app->params['msg_error'].'Unable to Imported Data.'.Yii::$app->params['msg_end'];
             Yii::$app->getSession()->setFlash('flash_msg', $msg);
           }
           return $this->redirect(['index']);
       }
       else
       {
         return $this->redirect(['index']);
       }
   }
   public function actionExportpdf()
   {
     $data=Users::find()->where(['is_deleted'=>'N','user_type'=>'U'])->all();
     $fname='user_report'.date('_d-m-Y');
     $dompdf = new Dompdf(array('enable_remote' => true));
     $html = $this->renderPartial('user_pdf.php',['data'=>$data]);
     $html2 = preg_replace('/>\s+</', "><", $html);
     $dompdf->loadHtml($html);
     $dompdf->setPaper('A4','portrait');
     $dompdf->render();
     $dompdf->stream($fname);
       exit;
   }
}
