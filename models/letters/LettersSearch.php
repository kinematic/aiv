<?php

namespace app\models\letters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\letters\Letters;

/**
 * LettersSearch represents the model behind the search form about `app\models\letters\Letters`.
 */
class LettersSearch extends Letters
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'objid', 'secondnameid', 'patronymicnameid', 'signid'], 'integer'],
            [['appeal1', 'appeal2', 'appeal3', 'firstname', 'text1', 'text2'], 'safe'],
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
        $query = Letters::find();

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
            'objid' => $this->objid,
            'secondnameid' => $this->secondnameid,
            'patronymicnameid' => $this->patronymicnameid,
            'signid' => $this->signid,
        ]);

        $query->andFilterWhere(['like', 'appeal1', $this->appeal1])
            ->andFilterWhere(['like', 'appeal2', $this->appeal2])
            ->andFilterWhere(['like', 'appeal3', $this->appeal3])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'text1', $this->text1])
            ->andFilterWhere(['like', 'text2', $this->text2]);

        return $dataProvider;
    }
}
