<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GelombangPendaftaran;

/**
 * GelombangPendaftaranSearch represents the model behind the search form of `backend\models\GelombangPendaftaran`.
 */
class GelombangPendaftaranSearch extends GelombangPendaftaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gelombang_pendaftaran_id', 'counter', 'is_online', 'is_bayar', 'jenis_ujian_id', 'minimum_n', 'base_n', 'multi_n'], 'integer'],
            [['tahun', 'desc', 'mulai', 'berakhir', 'prefix_kode_pendaftaran', 'tanggal_ujian', 'jam_mulai', 'jam_selesai'], 'safe'],
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
        $query = GelombangPendaftaran::find();

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
            'gelombang_pendaftaran_id' => $this->gelombang_pendaftaran_id,
            'tahun' => $this->tahun,
            'mulai' => $this->mulai,
            'berakhir' => $this->berakhir,
            'counter' => $this->counter,
            'is_online' => $this->is_online,
            'is_bayar' => $this->is_bayar,
            'jenis_ujian_id' => $this->jenis_ujian_id,
            'minimum_n' => $this->minimum_n,
            'base_n' => $this->base_n,
            'multi_n' => $this->multi_n,
            'tanggal_ujian' => $this->tanggal_ujian,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'prefix_kode_pendaftaran', $this->prefix_kode_pendaftaran]);

        return $dataProvider;
    }
}
