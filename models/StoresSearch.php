<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stores;

/**
 * StoresSearch represents the model behind the search form about `app\models\Stores`.
 */
class StoresSearch extends Stores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'protocol', 'active'], 'integer'],
            [['name', 'host', 'price_selector', 'price_old_selector', 'sale_selector', 'city_selector', 'cookies'], 'safe'],
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
        $query = Stores::find();

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
            'id' => $this->id,
            'protocol' => $this->protocol,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'host', $this->host])
            ->andFilterWhere(['like', 'price_selector', $this->price_selector])
            ->andFilterWhere(['like', 'price_old_selector', $this->price_old_selector])
            ->andFilterWhere(['like', 'sale_selector', $this->sale_selector])
            ->andFilterWhere(['like', 'city_selector', $this->city_selector])
            ->andFilterWhere(['like', 'cookies', $this->cookies]);

        return $dataProvider;
    }
}
