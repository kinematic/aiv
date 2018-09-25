<?php

namespace app\models\address;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\address\Contacts;

/**
 * ContactsSearch represents the model behind the search form about `app\models\Contacts`.
 */
class ContactsSearch extends Contacts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'objid'], 'integer'],
            [['contact', 'description'], 'safe'],
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
        $query = Contacts::find();

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
        ]);

        $query->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
