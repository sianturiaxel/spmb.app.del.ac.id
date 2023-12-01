<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Jurusan;

/**
 * JurusanSearch represents the model behind the search form of `backend\models\Jurusan`.
 */
class JurusanSearch extends Jurusan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jurusan_id', 'fakultas_id', 'counter_nim', 'status_active', 'afis_id'], 'integer'],
            [['nama', 'prefix_nim', 'url', 'desc'], 'safe'],
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
        $query = Jurusan::find();

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
            'jurusan_id' => $this->jurusan_id,
            'fakultas_id' => $this->fakultas_id,
            'counter_nim' => $this->counter_nim,
            'status_active' => $this->status_active,
            'afis_id' => $this->afis_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'prefix_nim', $this->prefix_nim])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
