<?php

namespace backend\modules\chi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\chi\models\Chitietchi;

/**
 * ChitietchiSearch represents the model behind the search form of `backend\modules\chi\models\Chitietchi`.
 */
class ChitietchiSearch extends Chitietchi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'quantity', 'accounting_id', 'employee_id', 'expenditure_id'], 'integer'],
            [['items_name', 'motorbike', 'sea_control','note'], 'safe'],
            [['money'], 'number'],
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
        $query = Chitietchi::find();

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
            'type' => $this->type,
            'quantity' => $this->quantity,
            'money' => $this->money,
            'accounting_id' => $this->accounting_id,
            'employee_id' => $this->employee_id,
            'expenditure_id' => $this->expenditure_id,
        ]);

        $query->andFilterWhere(['like', 'items_name', $this->items_name])
            ->andFilterWhere(['like', 'motorbike', $this->motorbike])
            ->andFilterWhere(['like', 'sea_control', $this->sea_control])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
