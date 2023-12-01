<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WaktuPengumuman;

/**
 * WaktuPengumumanSearch represents the model behind the search form of `backend\models\WaktuPengumuman`.
 */
class WaktuPengumumanSearch extends WaktuPengumuman
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['waktu_pengumuman_id', 'gelombang_pendaftaran_id', 'jenis_test_id'], 'integer'],
            [['tanggal_mulai', 'tanggal_akhir', 'catatan', 'created_by', 'created_date', 'updated_by', 'updated_date', 'deleted_by', 'deleted_date'], 'safe'],
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
        $query = WaktuPengumuman::find();

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
            'waktu_pengumuman_id' => $this->waktu_pengumuman_id,
            'gelombang_pendaftaran_id' => $this->gelombang_pendaftaran_id,
            'jenis_test_id' => $this->jenis_test_id,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_akhir' => $this->tanggal_akhir,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
            'deleted_date' => $this->deleted_date,
        ]);

        $query->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by]);

        return $dataProvider;
    }
}
