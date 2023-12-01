<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UangPembangunan;

/**
 * UangPembangunanSearch represents the model behind the search form of `backend\models\UangPembangunan`.
 */
class UangPembangunanSearch extends UangPembangunan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uang_pembangunan_id', 'gelombang_pendaftaran_id', 'jurusan_id', 'minimum_n', 'base_n', 'multi_n'], 'integer'],
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
        $query = UangPembangunan::find();

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
            'uang_pembangunan_id' => $this->uang_pembangunan_id,
            'gelombang_pendaftaran_id' => $this->gelombang_pendaftaran_id,
            'jurusan_id' => $this->jurusan_id,
            'minimum_n' => $this->minimum_n,
            'base_n' => $this->base_n,
            'multi_n' => $this->multi_n,
        ]);

        return $dataProvider;
    }
}
