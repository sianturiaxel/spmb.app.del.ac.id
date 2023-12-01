<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SekolahPmdk;

/**
 * SekolahPmdkSearch represents the model behind the search form of `backend\models\SekolahPmdk`.
 */
class SekolahPmdkSearch extends SekolahPmdk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sekolah_pmdk_id', 'sekolah_id'], 'integer'],
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
        $query = SekolahPmdk::find();

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
            'sekolah_pmdk_id' => $this->sekolah_pmdk_id,
            'sekolah_id' => $this->sekolah_id,
        ]);

        return $dataProvider;
    }
}
