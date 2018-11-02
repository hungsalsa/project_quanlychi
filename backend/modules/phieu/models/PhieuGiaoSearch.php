<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\phieu\models\PhieuGiao;

/**
 * PhieuGiaoSearch represents the model behind the search form of `backend\modules\phieu\models\PhieuGiao`.
 */
class PhieuGiaoSearch extends PhieuGiao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sophieu_dau', 'sophieu_cuoi', 'nguoi_giao', 'nguoi_nhan'], 'integer'],
            [['ngay_giao', 'note'], 'safe'],
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
        $query = PhieuGiao::find();

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
            'ngay_giao' => $this->ngay_giao,
            'sophieu_dau' => $this->sophieu_dau,
            'sophieu_cuoi' => $this->sophieu_cuoi,
            'nguoi_giao' => $this->nguoi_giao,
            'nguoi_nhan' => $this->nguoi_nhan,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
