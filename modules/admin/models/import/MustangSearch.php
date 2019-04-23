<?php

namespace app\modules\admin\models\import;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\import\Mustang;

/**
 * MustangSearch represents the model behind the search form of `app\modules\admin\models\import\Mustang`.
 */
class MustangSearch extends Mustang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['object', 'planedaddress', 'realaddress', 'juricaladdress', 'contacts', 'startdate', 'closedate', 'mol', 'status', 'inventory', 'lastinventorydate'], 'safe'],
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
        $query = Mustang::find();

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
        ]);

        $query->andFilterWhere(['ilike', 'object', $this->object])
            ->andFilterWhere(['ilike', 'planedaddress', $this->planedaddress])
            ->andFilterWhere(['ilike', 'realaddress', $this->realaddress])
            ->andFilterWhere(['ilike', 'juricaladdress', $this->juricaladdress])
            ->andFilterWhere(['ilike', 'contacts', $this->contacts])
            ->andFilterWhere(['ilike', 'mol', $this->mol])
            ->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'inventory', $this->inventory]);

        return $dataProvider;
    }
}
