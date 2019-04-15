<?php

namespace app\models\import;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\import\Sites;

/**
 * SitesSearch represents the model behind the search form of `app\models\import\Sites`.
 */
class SitesSearch extends Sites
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'inventory', 'typeid', 'regionid', 'siteid', 'statusid', 'molid'], 'integer'],
            [['object', 'planedaddress', 'realaddress', 'mol', 'status', 'lastinventorydate', 'juricaladdress', 'contacts', 'startdate', 'closedate', 'contractor', 'nr'], 'safe'],
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
        $query = Sites::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
		
		if($params['r'] == 'import/sites/new') {
			$query->leftJoin('rbs_sites.sites', 'rbs_mustang.sites.siteid = rbs_sites.sites.id');
			$query->innerJoin('rbs_sites.sitesregion', 'rbs_mustang.sites.regionid = rbs_sites.sitesregion.id');
			$query->where('rbs_sites.sites.id IS NULL');
			$query->andWhere('rbs_mustang.sites.statusid <> 7');
			$query->andWhere('rbs_sites.sitesregion.mustangimport');
			$query->orderBy('rbs_mustang.sites.typeid, rbs_mustang.sites.regionid, rbs_mustang.sites.nr');
		}

        if($params['r'] == 'import/sites/notdefs') {
			// $query->leftJoin('rbs_sites.sites', 'rbs_mustang.sites.siteid = rbs_sites.sites.id');
			// $query->innerJoin('rbs_sites.sitesregion', 'rbs_mustang.sites.regionid = rbs_sites.sitesregion.id');
			$query->where('rbs_mustang.sites.regionid IS NULL');
			$query->orWhere('rbs_mustang.sites.typeid IS NULL');
			$query->orderBy('rbs_mustang.sites.nr');
		}
		
			if($params['r'] == 'import/sites/nonexists') {
			$query->rightJoin('rbs_sites.sites', 'rbs_mustang.sites.siteid = rbs_sites.sites.id');
			$query->where('rbs_mustang.sites.id IS NULL');
			$query->orderBy('rbs_sites.sites.typeid, rbs_mustang.sites.regionid, rbs_mustang.sites.nr');
		}
		
		if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'inventory' => $this->inventory,
            'startdate' => $this->startdate,
            'closedate' => $this->closedate,
            'typeid' => $this->typeid,
            'regionid' => $this->regionid,
            'siteid' => $this->siteid,
            'statusid' => $this->statusid,
            'molid' => $this->molid,
        ]);

        $query->andFilterWhere(['like', 'object', $this->object])
            ->andFilterWhere(['like', 'planedaddress', $this->planedaddress])
            ->andFilterWhere(['like', 'realaddress', $this->realaddress])
            ->andFilterWhere(['like', 'mol', $this->mol])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'lastinventorydate', $this->lastinventorydate])
            ->andFilterWhere(['like', 'juricaladdress', $this->juricaladdress])
            ->andFilterWhere(['like', 'contacts', $this->contacts])
            ->andFilterWhere(['like', 'contractor', $this->contractor])
            ->andFilterWhere(['like', 'nr', $this->nr]);

        return $dataProvider;
    }
}
