<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_kode_ujian".
 *
 * @property int $kode_ujian_id
 * @property int $gelombang_pendaftaran_id
 * @property int $jenis_test_id
 * @property string|null $kode_ujian
 * @property string|null $username
 * @property string|null $password
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 */
class KodeUjian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_kode_ujian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gelombang_pendaftaran_id', 'jenis_test_id'], 'required'],
            [['gelombang_pendaftaran_id', 'jenis_test_id', 'status'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['kode_ujian', 'username', 'password', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_ujian_id' => 'Kode Ujian ID',
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
            'jenis_test_id' => 'Jenis Test ID',
            'kode_ujian' => 'Kode Ujian',
            'username' => 'Username',
            'password' => 'Password',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }
    public function getGelombangPendaftaran()
    {
        return $this->hasOne(GelombangPendaftaran::className(), ['gelombang_pendaftaran_id' => 'gelombang_pendaftaran_id']);
    }
    public function getJenisTest()
    {
        return $this->hasOne(JenisTest::className(), ['jenis_test_id' => 'jenis_test_id']);
    }
}
