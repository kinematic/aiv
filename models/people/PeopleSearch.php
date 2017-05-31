<?php

namespace app\models\people;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\people\People;

/**
 * PeopleSearch represents the model behind the search form about `app\models\people\People`.
 */
class PeopleSearch extends People
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'secondnameid', 'patronymicnameid', 'companyid', 'positionid'], 'integer'],
            [['firstname'], 'safe'],
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
        $query = People::find();

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
            'secondnameid' => $this->secondnameid,
            'patronymicnameid' => $this->patronymicnameid,
            'companyid' => $this->companyid,
            'positionid' => $this->positionid,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname]);

        return $dataProvider;
    }
}
