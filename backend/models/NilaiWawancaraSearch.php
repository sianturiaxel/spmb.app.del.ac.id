<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\NilaiWawancara;

/**
 * NilaiWawancaraSearch represents the model behind the search form of `backend\models\NilaiWawancara`.
 */
class NilaiWawancaraSearch extends NilaiWawancara
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nilai_wawancara_id', 'pendaftar_id'], 'integer'],
            [['nilai_motivasi', 'nilai_gambaran_karir', 'nilai_rekomendasi'], 'number'],
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
        $query = NilaiWawancara::find();

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
            'nilai_wawancara_id' => $this->nilai_wawancara_id,
            'pendaftar_id' => $this->pendaftar_id,
            'nilai_motivasi' => $this->nilai_motivasi,
            'nilai_gambaran_karir' => $this->nilai_gambaran_karir,
            'nilai_rekomendasi' => $this->nilai_rekomendasi,
        ]);

        return $dataProvider;
    }
}
