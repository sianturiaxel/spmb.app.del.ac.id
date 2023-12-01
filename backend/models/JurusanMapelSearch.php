<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JurusanMapel;

/**
 * JurusanMapelSearch represents the model behind the search form of `backend\models\JurusanMapel`.
 */
class JurusanMapelSearch extends JurusanMapel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jurusan_mapel_id', 'jurusan_id', 'mata_pelajaran_id'], 'integer'],
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
        $query = JurusanMapel::find();

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
            'jurusan_mapel_id' => $this->jurusan_mapel_id,
            'jurusan_id' => $this->jurusan_id,
            'mata_pelajaran_id' => $this->mata_pelajaran_id,
        ]);

        return $dataProvider;
    }
}
