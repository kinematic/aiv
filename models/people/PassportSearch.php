<?php

namespace app\models\people;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\people\Passport;

/**
 * PassportSearch represents the model behind the search form about `app\models\people\Passport`.
 */
class PassportSearch extends Passport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'manid'], 'integer'],
            [['number', 'issued', 'birthday', 'placebirth', 'registration', 'residence'], 'safe'],
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
        $query = Passport::find();

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
            'manid' => $this->manid,
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'issued', $this->issued])
            ->andFilterWhere(['like', 'placebirth', $this->placebirth])
            ->andFilterWhere(['like', 'registration', $this->registration])
            ->andFilterWhere(['like', 'residence', $this->residence]);

        return $dataProvider;
    }
}
