<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CalonMahasiswa;

/**
 * CalonMahasiswaSearch represents the model behind the search form of `backend\models\CalonMahasiswa`.
 */
class CalonMahasiswaSearch extends CalonMahasiswa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['calon_mahasiswa_id', 'pendaftar_id', 'jalur_pendaftaran_id', 'cis_imported', 'jurusan_id', 'user_id', 'jenis_kelamin_id', 'golongan_darah_id', 'agama_id', 'anak_ke', 'jumlah_bersaudara', 'jumlah_tanggungan_ortu', 'alamat_kec', 'alamat_kab', 'alamat_prov', 'kewarganegaraan_id', 'pendidikan_ayah_id', 'pendidikan_ibu_id', 'alamat_kec_orangtua', 'alamat_kab_orangtua', 'alamat_prov_orangtua', 'pekerjaan_ayah_id', 'pekerjaan_ibu_id', 'penghasilan_ayah_id', 'penghasilan_ibu_id', 'penghasilan_ayah', 'penghasilan_ibu', 'penghasilan_total', 'pekerjaan_wali_id', 'penghasilan_wali', 'alamat_wali', 'sekolah_id', 'npwp', 'kebutuhan_khusus_mahasiswa', 'informasi_del_id', 'n', 'status_pembayaran', 'jurusan_sekolah_id', 'sekolah_dapodik_id', 't_payment_detail'], 'integer'],
            [['nik', 'nisn', 'no_kps', 'nama', 'tanggal_lahir', 'tempat_lahir', 'alamat', 'kode_pos', 'kelurahan', 'no_telepon_rumah', 'no_telepon_mobile', 'email', 'nama_ayah_kandung', 'nama_ibu_kandung', 'nik_ayah', 'nik_ibu', 'tanggal_lahir_ayah', 'tanggal_lahir_ibu', 'alamat_orang_tua', 'kode_pos_orang_tua', 'no_telepon_mobile_ayah', 'no_telepon_mobile_ibu', 'nama_wali', 'nik_wali', 'no_hp_wali', 'jurusan_sekolah', 'akreditasi_sekolah', 'informasi_del_lainnya', 'nim', 'tanggal_pendaftaran', 'virtual_account_number', 'bank_name', 'pas_foto', 'berkas_pendaftaran_ulang', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
            [['total_pembayaran'], 'number'],
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
        $query = CalonMahasiswa::find();

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
            'calon_mahasiswa_id' => $this->calon_mahasiswa_id,
            'pendaftar_id' => $this->pendaftar_id,
            'jalur_pendaftaran_id' => $this->jalur_pendaftaran_id,
            'cis_imported' => $this->cis_imported,
            'jurusan_id' => $this->jurusan_id,
            'user_id' => $this->user_id,
            'jenis_kelamin_id' => $this->jenis_kelamin_id,
            'golongan_darah_id' => $this->golongan_darah_id,
            'tanggal_lahir' => $this->tanggal_lahir,
            'agama_id' => $this->agama_id,
            'anak_ke' => $this->anak_ke,
            'jumlah_bersaudara' => $this->jumlah_bersaudara,
            'jumlah_tanggungan_ortu' => $this->jumlah_tanggungan_ortu,
            'alamat_kec' => $this->alamat_kec,
            'alamat_kab' => $this->alamat_kab,
            'alamat_prov' => $this->alamat_prov,
            'kewarganegaraan_id' => $this->kewarganegaraan_id,
            'tanggal_lahir_ayah' => $this->tanggal_lahir_ayah,
            'tanggal_lahir_ibu' => $this->tanggal_lahir_ibu,
            'pendidikan_ayah_id' => $this->pendidikan_ayah_id,
            'pendidikan_ibu_id' => $this->pendidikan_ibu_id,
            'alamat_kec_orangtua' => $this->alamat_kec_orangtua,
            'alamat_kab_orangtua' => $this->alamat_kab_orangtua,
            'alamat_prov_orangtua' => $this->alamat_prov_orangtua,
            'pekerjaan_ayah_id' => $this->pekerjaan_ayah_id,
            'pekerjaan_ibu_id' => $this->pekerjaan_ibu_id,
            'penghasilan_ayah_id' => $this->penghasilan_ayah_id,
            'penghasilan_ibu_id' => $this->penghasilan_ibu_id,
            'penghasilan_ayah' => $this->penghasilan_ayah,
            'penghasilan_ibu' => $this->penghasilan_ibu,
            'penghasilan_total' => $this->penghasilan_total,
            'pekerjaan_wali_id' => $this->pekerjaan_wali_id,
            'penghasilan_wali' => $this->penghasilan_wali,
            'alamat_wali' => $this->alamat_wali,
            'sekolah_id' => $this->sekolah_id,
            'npwp' => $this->npwp,
            'kebutuhan_khusus_mahasiswa' => $this->kebutuhan_khusus_mahasiswa,
            'informasi_del_id' => $this->informasi_del_id,
            'n' => $this->n,
            'tanggal_pendaftaran' => $this->tanggal_pendaftaran,
            'status_pembayaran' => $this->status_pembayaran,
            'total_pembayaran' => $this->total_pembayaran,
            'jurusan_sekolah_id' => $this->jurusan_sekolah_id,
            'sekolah_dapodik_id' => $this->sekolah_dapodik_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            't_payment_detail' => $this->t_payment_detail,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'nisn', $this->nisn])
            ->andFilterWhere(['like', 'no_kps', $this->no_kps])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'kode_pos', $this->kode_pos])
            ->andFilterWhere(['like', 'kelurahan', $this->kelurahan])
            ->andFilterWhere(['like', 'no_telepon_rumah', $this->no_telepon_rumah])
            ->andFilterWhere(['like', 'no_telepon_mobile', $this->no_telepon_mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nama_ayah_kandung', $this->nama_ayah_kandung])
            ->andFilterWhere(['like', 'nama_ibu_kandung', $this->nama_ibu_kandung])
            ->andFilterWhere(['like', 'nik_ayah', $this->nik_ayah])
            ->andFilterWhere(['like', 'nik_ibu', $this->nik_ibu])
            ->andFilterWhere(['like', 'alamat_orang_tua', $this->alamat_orang_tua])
            ->andFilterWhere(['like', 'kode_pos_orang_tua', $this->kode_pos_orang_tua])
            ->andFilterWhere(['like', 'no_telepon_mobile_ayah', $this->no_telepon_mobile_ayah])
            ->andFilterWhere(['like', 'no_telepon_mobile_ibu', $this->no_telepon_mobile_ibu])
            ->andFilterWhere(['like', 'nama_wali', $this->nama_wali])
            ->andFilterWhere(['like', 'nik_wali', $this->nik_wali])
            ->andFilterWhere(['like', 'no_hp_wali', $this->no_hp_wali])
            ->andFilterWhere(['like', 'jurusan_sekolah', $this->jurusan_sekolah])
            ->andFilterWhere(['like', 'akreditasi_sekolah', $this->akreditasi_sekolah])
            ->andFilterWhere(['like', 'informasi_del_lainnya', $this->informasi_del_lainnya])
            ->andFilterWhere(['like', 'nim', $this->nim])
            ->andFilterWhere(['like', 'virtual_account_number', $this->virtual_account_number])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'pas_foto', $this->pas_foto])
            ->andFilterWhere(['like', 'berkas_pendaftaran_ulang', $this->berkas_pendaftaran_ulang])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
