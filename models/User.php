<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $user_name;
    public $image;
    public $password;
    public $authKey;
    public $accessToken;
    public $email_id;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $User = Users::find()->where(["id" => $id])->one();
        if (!count($User))
        {
            return null;
        }
        else
        {
            $dbUser = [
                'id' => $User->id,
                'user_type'=>$User->user_type,
                'user_name'=>$User->user_name,
                'password' => $User->password,
                'email_id' => $User->email_id,
                //'authKey' => "test".$User->id."key",
                //'accessToken' => "fashionapp".$User->id,
            ];
            return new static($dbUser);
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
      $User = Users::findOne(['access_token' => $token]);
      if (!count($User))
      {
          return null;
      }
      else
      {
          $dbUser = [
              'id' => $User->id,
              'user_type'=>$User->user_type,
              'user_name'=>$User->user_name,
              'password' => $User->password,
              'email_id' => $User->email_id,
              //'authKey' => "test".$User->id."key",
              //'accessToken' => "fashionapp".$User->id,
          ];
          return new static($dbUser);
      }
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
      $User = Users::find()->where(["email_id" => $username])->andWhere(['is_deleted'=>'N','user_type'=>'U'])->one();
      if (!count($User))
      {
          return null;
      }
      else
      {
          $dbUser = [
              'id' => $User->id,
              'user_type'=>$User->user_type,
              'user_name'=>$User->user_name,
              'password' => $User->password,
              'email_id' => $User->email_id,
              //'authKey' => "test".$User->id."key",
              //'accessToken' => "fashionapp".$User->id,
          ];
          return new static($dbUser);
      }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
      return $this->password === md5($password);
    }
}
