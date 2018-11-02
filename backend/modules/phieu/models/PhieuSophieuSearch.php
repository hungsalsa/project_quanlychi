<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\phieu\models\PhieuSophieu;

/**
 * PhieuSophieuSearch represents the model behind the search form of `backend\modules\phieu\models\PhieuSophieu`.
 */
class PhieuSophieuSearch extends PhieuSophieu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'so_phieu'], 'integer'],
            [['ngay_giao', 'ngay_sd', 'ngay_tt', 'status'], 'safe'],
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
        $query = PhieuSophieu::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'ngay_giao' => [
                    'asc' => ['ngay_giao' => SORT_ASC],
                    'desc' => ['ngay_giao' => SORT_DESC],
                    'default' => SORT_DESC
                ],
                'so_phieu' => [
                    'asc' => ['so_phieu' => SORT_ASC],
                    'desc' => ['so_phieu' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'ngay_sd' => [
                    'asc' => ['ngay_sd' => SORT_ASC],
                    'desc' => ['ngay_sd' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'ngay_tt' => [
                    'asc' => ['ngay_tt' => SORT_ASC],
                    'desc' => ['ngay_tt' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
                'ngay_giao' => SORT_DESC,
                'so_phieu' => SORT_ASC,
                'ngay_sd' => SORT_ASC,
                'ngay_tt' => SORT_ASC,
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
            'ngay_giao' => $this->ngay_giao,
            'ngay_sd' => $this->ngay_sd,
            'ngay_tt' => $this->ngay_tt,
            'so_phieu' => $this->so_phieu,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
