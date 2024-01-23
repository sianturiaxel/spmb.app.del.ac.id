<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PenangguhanDaftarUlang;

/**
 * PenangguhanDaftarUlangSearch represents the model behind the search form of `backend\models\PenangguhanDaftarUlang`.
 */
class PenangguhanDaftarUlangSearch extends PenangguhanDaftarUlang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['penangguhan_daftar_ulang_id', 'calon_mahasiswa_id', 'approve_panitia', 'approve_keuangan'], 'integer'],
            [['total_ditangguhkan', 'total_bayar'], 'number'],
            [['tanggal_penangguhan', 'catatan', 'created_by', 'created_date', 'updated_by', 'updated_date', 'deleted_by', 'deleted_date'], 'safe'],
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
        $query = PenangguhanDaftarUlang::find();

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
            'penangguhan_daftar_ulang_id' => $this->penangguhan_daftar_ulang_id,
            'calon_mahasiswa_id' => $this->calon_mahasiswa_id,
            'total_ditangguhkan' => $this->total_ditangguhkan,
            'total_bayar' => $this->total_bayar,
            'tanggal_penangguhan' => $this->tanggal_penangguhan,
            'approve_panitia' => $this->approve_panitia,
            'approve_keuangan' => $this->approve_keuangan,
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
