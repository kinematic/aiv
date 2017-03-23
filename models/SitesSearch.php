<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sites;

/**
 * SitesSearch represents the model behind the search form about `app\models\Sites`.
 */
class SitesSearch extends Sites
{
    public $oblid;
    public $siteid;
	public $relation;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeid', 'regionid', 'objid', 'relationid', 'statusid', 'molid', 'oblid', 'siteid'], 'integer'],
            [['nr', 'description', 'opendate', 'closedate', 'inventdate', 'sitename', 'relation'], 'safe'],
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

        $dataProvider->setSort([
            'attributes' => [
                'typeid' => [
                    'asc' => ['typeid' => SORT_ASC],
                    'desc' => ['typeid' => SORT_DESC],
                    'label' => 'типы',
                ],
                'regionid' => [
                    'asc' => ['regionid' => SORT_ASC],
                    'desc' => ['regionid' => SORT_DESC],
                    'label' => 'регионы',
                ],
                'nr' => [
                    'asc' => ['nr' => SORT_ASC],
                    'desc' => ['nr' => SORT_DESC],
                    'label' => 'номера',
                    
                ],
                'defaultOrder' => [
                    'nr' => SORT_ASC
                ],
            ]
        ]);
        
       $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        //if (!($this->load($params) && $this->validate())) {
            /**
            * Жадная загрузка данных модели Страны
            * для работы сортировки.
            */
            //$query->joinWith(['sitestype']);
            //$query->joinWith(['sitesregion']);
            //return $dataProvider;
        //}

        // grid filtering conditions
//         $query->andFilterWhere([
//             'id' => $this->id,
//             'typeid' => $this->typeid,
//             'regionid' => $this->regionid,
//             'objid' => $this->objid,
//             'relationid' => $this->relationid,
//             'statusid' => $this->statusid,
//             'opendate' => $this->opendate,
//             'closedate' => $this->closedate,
//             'molid' => $this->molid,
//             'inventdate' => $this->inventdate,
//         ]);

        $query->andFilterWhere(['typeid' => $this->typeid])
	    ->andFilterWhere(['regionid' => $this->regionid])
	    
	    ->andFilterWhere(['like', 'description', $this->description]);
	    
	    if (strlen($this->searchNr) == 3) $query->andFilterWhere(
					[
						'or', 
						['like', 'nr', $this->searchNr, false],
						['like', 'nr', $this->searchOtherNr, false],
						['like', 'nr', '%0' . $this->searchNr, false],
						['like', 'nr', '%0' . $this->searchOtherNr, false],
					]
				);
		else $query->andFilterWhere(
				[
					'or', 
					['like', 'nr', '%' . $this->nr, false],
					['like', 'nr', '%' . $this->searchOtherNr, false],
				]);
		
//         ;
//         //$query->andWhere('sitestype.name LIKE "%' . $this->type . '%"');
//         $query->joinWith(['sitestype' => function ($q) {
//         $q->where('sitestype.name LIKE "%' . $this->type . '%"');
//     }])
//     ;
		if (isset($this->relation)) {
			$query->innerJoinWith(['sitesregion']);
			$query->andWhere(['sitesregion.oblid' => $this->oblid]);
			$query->andWhere('sites.id <> ' . $this->siteid);
			$query->andWhere('LENGTH(nr) < IF(LENGTH(' . $this->nr . ') < 5, 7, 12)');
			if ($this->relation == 'nonObject') $query->andWhere('objid IS NULL');
			if ($this->relation == 'withObject') $query->andFilterWhere(['<>', 'objid', $this->objid]);
			$query->orderBy('objid, typeid, nr');
		} else $query->orderBy('nr');
            

        return $dataProvider;
    }
}
