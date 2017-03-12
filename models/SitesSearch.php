<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use yii\helpers\ArrayHelper;
use app\models\Sites;

/**
 * SitesSearch represents the model behind the search form about `app\models\Sites`.
 */
class SitesSearch extends Sites
{
    public $sitename;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeid', 'regionid', 'objid', 'relationid', 'statusid', 'molid'], 'integer'],
            [['nr', 'description', 'opendate', 'closedate', 'inventdate', 'sitename'], 'safe'],
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
        $query = Sites::find()->joinWith(['sitestype'])->joinWith(['sitesregion'])->addOrderBy('nr');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
//                 'sitename' => [
//                     'asc' => ['sitestype.name' => SORT_ASC, 'sitesregion.name' => SORT_ASC, 'nr' => SORT_ASC],
//                     'desc' => ['sitestype.name' => SORT_DESC, 'sitesregion.name' => SORT_DESC, 'nr' => SORT_DESC],
//                     'label' => 'Сайты'
//                 ],
//                 'type' => [
//                     'asc' => ['sitestype.name' => SORT_ASC],
//                     'desc' => ['sitestype.name' => SORT_DESC],
//                     'label' => 'Типы',
//                     //'filter'=>ArrayHelper::map(Sitestype::find()->asArray()->all(), 'id', 'name'),
//                 ],
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
	    ->andFilterWhere(['like', 'nr', $this->nr])
            ->andFilterWhere(['like', 'description', $this->description])
        ;
//         //$query->andWhere('sitestype.name LIKE "%' . $this->type . '%"');
//         $query->joinWith(['sitestype' => function ($q) {
//         $q->where('sitestype.name LIKE "%' . $this->type . '%"');
//     }])
//     ;
            
            

        return $dataProvider;
    }
}
