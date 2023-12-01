<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UangDaftarUlang;

/**
 * UangDaftarUlangSearch represents the model behind the search form of `backend\models\UangDaftarUlang`.
 */
class UangDaftarUlangSearch extends UangDaftarUlang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uang_daftar_ulang_id', 'gelombang_pendaftaran_id', 'perlengkapan_mhs', 'perlengkapan_makan', 'spp_tahap_1'], 'integer'],
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
        $query = UangDaftarUlang::find();

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
            'uang_daftar_ulang_id' => $this->uang_daftar_ulang_id,
            'gelombang_pendaftaran_id' => $this->gelombang_pendaftaran_id,
            'perlengkapan_mhs' => $this->perlengkapan_mhs,
            'perlengkapan_makan' => $this->perlengkapan_makan,
            'spp_tahap_1' => $this->spp_tahap_1,
        ]);

        return $dataProvider;
    }
}
