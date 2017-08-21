<?php

namespace app\models\inventory;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\inventory\Sites;

/**
 * SitesSearch represents the model behind the search form about `app\models\inventory\Sites`.
 */
class SitesSearch extends Sites
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeid', 'regionid', 'objid', 'relationid', 'statusid', 'molid'], 'integer'],
            [['nr', 'mustangaddress', 'description', 'opendate', 'closedate', 'inventdate'], 'safe'],
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
        $query = Sites::find();

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
            'typeid' => $this->typeid,
            'regionid' => $this->regionid,
            'objid' => $this->objid,
            'relationid' => $this->relationid,
            'statusid' => $this->statusid,
            'opendate' => $this->opendate,
            'closedate' => $this->closedate,
            'molid' => $this->molid,
            'inventdate' => $this->inventdate,
        ]);

        $query->andFilterWhere(['like', 'nr', $this->nr])
            ->andFilterWhere(['like', 'mustangaddress', $this->mustangaddress])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
