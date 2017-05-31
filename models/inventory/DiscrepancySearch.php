<?php

namespace app\models\inventory;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\inventory\Discrepancy;
use app\models\Sites;

/**
 * DiscrepancySearch represents the model behind the search form about `app\models\inventory\Discrepancy`.
 */
class DiscrepancySearch extends Discrepancy
{
// 	public $siteID;
// 	public $discrepancy;
	public $codename;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'siteid', 'catalogid', 'discrepancyid'], 'integer'],
            [['codename'], 'string'],
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
        $query = Discrepancy::find();
		$query->innerJoinWith(['catalog']);
		$query->innerJoinWith(['sites']);
		$query->orderBy('objid, siteid, codename');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        
        if($this->siteid) $siteArray = Sites::find()->select('sites.id')->innerJoinWith('objectsites o')->where(['o.id' => $this->siteid]);
        else $siteArray = null;
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
//         if($this->siteID) $query->andWhere(['siteid' => $this->siteID]);
// 		$query->andWhere(['siteid' => $this->siteID]);
        // grid filtering conditions

//         if($this->discrepancy == 'излишек') $this->discrepancyid = 2;
//         if($this->discrepancy == 'недостача') $this->discrepancyid = 1;
        $query->andFilterWhere([
            'siteid' => $siteArray,
        ]);
        $query->andFilterWhere(['like', 'codename', $this->codename . '%', false
        ]);
        $query->andFilterWhere([    
            'discrepancyid' => $this->discrepancyid,
        ]);

        return $dataProvider;
    }
}
