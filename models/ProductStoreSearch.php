<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductStore;

/**
 * ProductStoreSearch represents the model behind the search form about `app\models\ProductStore`.
 */
class ProductStoreSearch extends ProductStore
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'product_id', 'active', 'id'], 'integer'],
            [['product_uri'], 'safe'],
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
        $query = ProductStore::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'store_id' => $this->store_id,
            'product_id' => $this->product_id,
            'active' => $this->active,
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'product_uri', $this->product_uri]);

        return $dataProvider;
    }
}
