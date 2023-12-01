<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\NilaiPsikotes;

/**
 * NilaiPsikotesSearch represents the model behind the search form of `backend\models\NilaiPsikotes`.
 */
class NilaiPsikotesSearch extends NilaiPsikotes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nilai_psikotes_id', 'pendaftar_id', 'tiu', 'iq', 'peringkat'], 'integer'],
            [['kode_tes', 'kehadiran', 'kategori_tiu', 'stabilit_as_emosi', 'temp_kerja', 'ketelitian', 'konsistensi', 'daya_tahan', 'kategori_iq', 'hasil', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'safe'],
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
        $query = NilaiPsikotes::find();

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
            'nilai_psikotes_id' => $this->nilai_psikotes_id,
            'pendaftar_id' => $this->pendaftar_id,
            'tiu' => $this->tiu,
            'iq' => $this->iq,
            'peringkat' => $this->peringkat,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'kode_tes', $this->kode_tes])
            ->andFilterWhere(['like', 'kehadiran', $this->kehadiran])
            ->andFilterWhere(['like', 'kategori_tiu', $this->kategori_tiu])
            ->andFilterWhere(['like', 'stabilit_as_emosi', $this->stabilit_as_emosi])
            ->andFilterWhere(['like', 'temp_kerja', $this->temp_kerja])
            ->andFilterWhere(['like', 'ketelitian', $this->ketelitian])
            ->andFilterWhere(['like', 'konsistensi', $this->konsistensi])
            ->andFilterWhere(['like', 'daya_tahan', $this->daya_tahan])
            ->andFilterWhere(['like', 'kategori_iq', $this->kategori_iq])
            ->andFilterWhere(['like', 'hasil', $this->hasil])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
