<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\phieu\models\PhieuSudung;

/**
 * PhieuSudungSearch represents the model behind the search form of `backend\modules\phieu\models\PhieuSudung`.
 */
class PhieuSudungSearch extends PhieuSudung
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'so_phieu_dau', 'so_phieu_cuoi', 'sl_phieu_tot', 'ke_toan', 'created_at', 'updated_at', 'user_create'], 'integer'],
            [['ngay_sd', 'phieu_huy', 'note', 'status'], 'safe'],
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
        $query = PhieuSudung::find();

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
            'so_phieu_dau' => $this->so_phieu_dau,
            'so_phieu_cuoi' => $this->so_phieu_cuoi,
            'ngay_sd' => $this->ngay_sd,
            'sl_phieu_tot' => $this->sl_phieu_tot,
            'ke_toan' => $this->ke_toan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_create' => $this->user_create,
        ]);

        $query->andFilterWhere(['like', 'phieu_huy', $this->phieu_huy])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
