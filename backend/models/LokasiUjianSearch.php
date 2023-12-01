<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LokasiUjian;

/**
 * LokasiUjianSearch represents the model behind the search form of `backend\models\LokasiUjian`.
 */
class LokasiUjianSearch extends LokasiUjian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lokasi_ujian_id', 'gelombang_pendaftaran_id', 'jenis_test_id', 'is_active'], 'integer'],
            [['kode_lokasi', 'gedung', 'alamat', 'tanggal_mulai', 'tanggal_selesai', 'desc', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'safe'],
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
        $query = LokasiUjian::find();

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
            'lokasi_ujian_id' => $this->lokasi_ujian_id,
            'gelombang_pendaftaran_id' => $this->gelombang_pendaftaran_id,
            'jenis_test_id' => $this->jenis_test_id,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'kode_lokasi', $this->kode_lokasi])
            ->andFilterWhere(['like', 'gedung', $this->gedung])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
