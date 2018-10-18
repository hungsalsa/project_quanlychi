<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quantri\models\News;

/**
 * NewsSearch represents the model behind the search form of `backend\modules\quantri\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'hot', 'view', 'sort', 'user_add'], 'integer'],
            [['name', 'link', 'images', 'htmltitle', 'htmlkeyword', 'htmldescriptions', 'content', 'tag', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = News::find();

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
            'category_id' => $this->category_id,
            'hot' => $this->hot,
            'view' => $this->view,
            'sort' => $this->sort,
            'user_add' => $this->user_add,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'htmltitle', $this->htmltitle])
            ->andFilterWhere(['like', 'htmlkeyword', $this->htmlkeyword])
            ->andFilterWhere(['like', 'htmldescriptions', $this->htmldescriptions])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
