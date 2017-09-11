<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_master".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $user_type
 * @property string $email_id
 * @property string $password
 * @property string $image_path
 * @property string $forgot_password_token
 * @property string $forgot_password_token_timeout
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class Users extends \yii\db\ActiveRecord
{
  public $PasswordConfirm,$oldPassword;
  // temporary variables
  public $temp1,$temp2,$temp3;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type', 'is_active', 'is_deleted','access_token','device_id','device_type'], 'string'],
            [['i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['user_name', 'email_id', 'password', 'image_path', 'forgot_password_token', 'forgot_password_token_timeout'], 'string', 'max' => 255],
            ['oldPassword', 'findPasswords','on'=>'changepassword'],
            ['email_id','required','on'=>'forgotpassword'],
            ['email_id','email','on'=>'forgotpassword'],
            [['password','PasswordConfirm','oldPassword'],'required','on'=>'changepassword'],
            [['password','PasswordConfirm'],'string','min'=>6,"max"=>15,'on'=>'changepassword'],
            ['PasswordConfirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Password and Confirm password does not match",'on'=>'changepassword'],
        ];
    }
    //matching the old password with your existing password.
    public function findPasswords($attribute, $params)
    {
        $user = self::findOne(Yii::$app->user->id);
        if ($user->password != md5($this->oldPassword))
            $this->addError($attribute, 'Old password is incorrect.');
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'user_type' => 'User Type',
            'email_id' => 'Email ID',
            'password' => 'Password',
            'image_path' => 'Image Path',
            'forgot_password_token' => 'Forgot Password Token',
            'forgot_password_token_timeout' => 'Forgot Password Token Timeout',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'i_by' => 'I By',
            'i_date' => 'I Date',
            'u_by' => 'U By',
            'u_date' => 'U Date',
        ];
    }
}
