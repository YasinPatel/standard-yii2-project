<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * Usersearch represents the model behind the search form about `app\models\Users`.
 */
class Usersearch extends Users
{
  public $search_var;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['user_name', 'user_type', 'email_id', 'password', 'image_path', 'forgot_password_token', 'forgot_password_token_timeout', 'is_active', 'is_deleted','search_var'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Users::find();
        $query->where(['is_deleted'=>'N','user_type'=>'U']);

        $session = Yii::$app->session;
        $size = $session->get('user.size');

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
           'pagination'=>['pagesize'=> isset($size)?$size:5],
           'sort' => ['defaultOrder' => ['id' => SORT_DESC],'attributes'=>['id']],
       ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // echo "<pre>";
        // print_r($params);
        // print_r($this->search_var);
        // die;

        $query->andFilterWhere([
          'OR',
          ['like', 'user_name', $this->search_var],
          ['like', 'email_id', $this->search_var],
          ['like', 'is_active', $this->search_var],
        ]);

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'i_by' => $this->i_by,
        //     'i_date' => $this->i_date,
        //     'u_by' => $this->u_by,
        //     'u_date' => $this->u_date,
        // ]);

        // $query->andFilterWhere(['like', 'user_name', $this->user_name])
        //     ->andFilterWhere(['like', 'user_type', $this->user_type])
        //     ->andFilterWhere(['like', 'email_id', $this->email_id])
        //     ->andFilterWhere(['like', 'password', $this->password])
        //     ->andFilterWhere(['like', 'image_path', $this->image_path])
        //     ->andFilterWhere(['like', 'forgot_password_token', $this->forgot_password_token])
        //     ->andFilterWhere(['like', 'forgot_password_token_timeout', $this->forgot_password_token_timeout])
        //     ->andFilterWhere(['like', 'is_active', $this->is_active])
        //     ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
