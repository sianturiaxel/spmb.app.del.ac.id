<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\NilaiAkademik;

/**
 * NilaiAkademikSearch represents the model behind the search form of `backend\models\NilaiAkademik`.
 */
class NilaiAkademikSearch extends NilaiAkademik
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nilai_akademik_id', 'pendaftar_id', 'mat_benar', 'mat_salah', 'ing_benar', 'ing_salah', 'tpa_benar', 'tpa_salah', 'total_kosong', 'jumlah_soal', 'hasil_score'], 'integer'],
            [['mp_tinggi', 'mp_rendah', 'perbandingan_mat_ing', 'usulan_panitia', 'pilihan1', 'pilihan2', 'pilihan3', 'hasil_akhir_pilihan', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'safe'],
            [['scala_score'], 'number'],
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
        $query = NilaiAkademik::find();

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
            'nilai_akademik_id' => $this->nilai_akademik_id,
            'pendaftar_id' => $this->pendaftar_id,
            'mat_benar' => $this->mat_benar,
            'mat_salah' => $this->mat_salah,
            'ing_benar' => $this->ing_benar,
            'ing_salah' => $this->ing_salah,
            'tpa_benar' => $this->tpa_benar,
            'tpa_salah' => $this->tpa_salah,
            'total_kosong' => $this->total_kosong,
            'jumlah_soal' => $this->jumlah_soal,
            'hasil_score' => $this->hasil_score,
            'scala_score' => $this->scala_score,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'mp_tinggi', $this->mp_tinggi])
            ->andFilterWhere(['like', 'mp_rendah', $this->mp_rendah])
            ->andFilterWhere(['like', 'perbandingan_mat_ing', $this->perbandingan_mat_ing])
            ->andFilterWhere(['like', 'usulan_panitia', $this->usulan_panitia])
            ->andFilterWhere(['like', 'pilihan1', $this->pilihan1])
            ->andFilterWhere(['like', 'pilihan2', $this->pilihan2])
            ->andFilterWhere(['like', 'pilihan3', $this->pilihan3])
            ->andFilterWhere(['like', 'hasil_akhir_pilihan', $this->hasil_akhir_pilihan])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
