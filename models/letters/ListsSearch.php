<?php

namespace app\models\letters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\letters\Lists;

/**
 * ListsSearch represents the model behind the search form of `app\models\letters\Lists`.
 */
class ListsSearch extends Lists
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'letterid', 'manid'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Lists::find();

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
            'letterid' => $this->letterid,
            'manid' => $this->manid,
        ]);

        return $dataProvider;
    }
}
