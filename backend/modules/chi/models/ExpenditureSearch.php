<?php

namespace backend\modules\chi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\chi\models\Expenditure;

/**
 * ExpenditureSearch represents the model behind the search form of `backend\modules\chi\models\Expenditure`.
 */
class ExpenditureSearch extends Expenditure
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total_money', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['day', 'status','note',], 'safe'],
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
        $query = Expenditure::find();

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
            'day' => $this->day,
            'total_money' => $this->total_money,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
