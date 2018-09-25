<?php

namespace app\models\sites;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\sites\Sitesforupdate;

/**
 * SitesforupdateSearch represents the model behind the search form about `app\models\sites\Sitesforupdate`.
 */
class SitesforupdateSearch extends Sitesforupdate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeid', 'regionid', 'siteid', 'statusid', 'molid'], 'integer'],
            [['name', 'planedaddress', 'realaddress', 'juricaladdress', 'startdate', 'closedate', 'mol', 'status', 'isinventory', 'lastinventorydate', 'nr'], 'safe'],
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
        $query = Sitesforupdate::find();

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
            'startdate' => $this->startdate,
            'closedate' => $this->closedate,
            'lastinventorydate' => $this->lastinventorydate,
            'typeid' => $this->typeid,
            'regionid' => $this->regionid,
            'siteid' => $this->siteid,
            'statusid' => $this->statusid,
            'molid' => $this->molid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'planedaddress', $this->planedaddress])
            ->andFilterWhere(['like', 'realaddress', $this->realaddress])
            ->andFilterWhere(['like', 'juricaladdress', $this->juricaladdress])
            ->andFilterWhere(['like', 'mol', $this->mol])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'isinventory', $this->isinventory])
            ->andFilterWhere(['like', 'nr', $this->nr]);

        return $dataProvider;
    }
}
