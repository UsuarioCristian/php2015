<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RouteCommerce;

/**
 * RouteCommerceSearch represents the model behind the search form about `app\models\RouteCommerce`.
 */
class RouteCommerceSearch extends RouteCommerce
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route_id', 'commerce_id', 'position', 'visited'], 'integer'],
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
        $query = RouteCommerce::find();

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
            'route_id' => $this->route_id,
            'commerce_id' => $this->commerce_id,
            'position' => $this->position,
            'visited' => $this->visited,
        ]);

        return $dataProvider;
    }
}
