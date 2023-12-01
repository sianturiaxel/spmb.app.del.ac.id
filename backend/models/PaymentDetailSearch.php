<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PaymentDetail;

/**
 * PaymentDetailSearch represents the model behind the search form of `backend\models\PaymentDetail`.
 */
class PaymentDetailSearch extends PaymentDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_detail_id', 'calon_mahasiswa_id'], 'integer'],
            [['total_amount'], 'number'],
            [['fee_name'], 'safe'],
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
        $query = PaymentDetail::find();

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
            'payment_detail_id' => $this->payment_detail_id,
            'calon_mahasiswa_id' => $this->calon_mahasiswa_id,
            'total_amount' => $this->total_amount,
        ]);

        $query->andFilterWhere(['like', 'fee_name', $this->fee_name]);

        return $dataProvider;
    }
}
