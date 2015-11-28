<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CommerceProduct;

/**
 * CommerceProductSearch represents the model behind the search form about `app\models\CommerceProduct`.
 */
class CommerceProductSearch extends CommerceProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commerce_id', 'product_id', 'stock', 'sold'], 'integer'],
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
        $query = CommerceProduct::find();

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
            'product_id' => $this->product_id,
            'stock' => $this->stock,
            'sold' => $this->sold,
        ]);

        return $dataProvider;
    }
}
