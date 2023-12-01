<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BerkasDaftarUlang;

/**
 * BerkasDaftarUlangSearch represents the model behind the search form of `backend\models\BerkasDaftarUlang`.
 */
class BerkasDaftarUlangSearch extends BerkasDaftarUlang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['berkas_daftar_ulang_id', 'is_active', 'deleted'], 'integer'],
            [['name', 'desc', 'berkas', 'link'], 'safe'],
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
        $query = BerkasDaftarUlang::find();

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
            'berkas_daftar_ulang_id' => $this->berkas_daftar_ulang_id,
            'is_active' => $this->is_active,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'berkas', $this->berkas])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
