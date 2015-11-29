<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CommerceEmployee;

/**
 * CommerceEmployeeSearch represents the model behind the search form about `app\models\CommerceEmployee`.
 */
class CommerceEmployeeSearch extends CommerceEmployee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commerce_id', 'employee_id'], 'integer'],
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
        $query = CommerceEmployee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'commerce_id' => $this->commerce_id,
            'employee_id' => $this->employee_id,
        ]);

        return $dataProvider;
    }
}
