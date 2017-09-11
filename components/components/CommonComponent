<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use yii\web\Session;
use app\models\Users;

class MyComponent extends Component
{
  public function getDashboardCount()
  {
    $result['users']=Users::find()->where(['is_deleted'=>'N'])->count();

    return $result;
  }
}
?>
