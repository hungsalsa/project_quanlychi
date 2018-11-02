<?php

namespace backend\modules\chi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\chi\models\Chingay;

/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class ChingaySearch extends Chingay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total_money','cuahang_id', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['day', 'note', 'status'], 'safe'],
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
        $query = Chingay::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'updated_at' => [
                    'asc' => ['updated_at' => SORT_ASC],
                    'desc' => ['updated_at' => SORT_DESC],
                    'default' => SORT_ASC
                ],                
                'day' => [
                    'asc' => ['day' => SORT_ASC],
                    'desc' => ['day' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'total_money' => [
                    'asc' => ['total_money' => SORT_ASC],
                    'desc' => ['total_money' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'note' => [
                    'asc' => ['note' => SORT_ASC],
                    'desc' => ['note' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'status' => [
                    'asc' => ['status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'user_add' => [
                    'asc' => ['user_add' => SORT_ASC],
                    'desc' => ['user_add' => SORT_DESC],
                    'default' => SORT_ASC,
                ]
            ],
            'defaultOrder' => [
                'updated_at' => SORT_DESC,
                'day' => SORT_ASC,
                'total_money' => SORT_ASC,
            ]
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
            'cuahang_id' => $this->cuahang_id,
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
