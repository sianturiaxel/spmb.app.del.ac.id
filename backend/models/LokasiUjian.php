<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "t_r_lokasi_ujian".
 *
 * @property int $lokasi_ujian_id
 * @property int|null $gelombang_pendaftaran_id
 * @property int|null $jenis_test_id
 * @property string|null $kode_lokasi
 * @property string|null $gedung
 * @property string|null $alamat
 * @property string|null $tanggal_mulai
 * @property string|null $tanggal_selesai
 * @property string|null $desc
 * @property int|null $is_active 0: not active, 1: active
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 */
class LokasiUjian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_lokasi_ujian';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className() => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            BlameableBehavior::className() => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gelombang_pendaftaran_id', 'jenis_test_id', 'is_active'], 'integer'],
            [['tanggal_mulai', 'tanggal_selesai', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['kode_lokasi'], 'string', 'max' => 3],
            [['gedung', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 100],
            [['alamat', 'desc'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lokasi_ujian_id' => 'Lokasi Ujian ID',
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
            'jenis_test_id' => 'Jenis Test ID',
            'kode_lokasi' => 'Kode Lokasi',
            'gedung' => 'Gedung',
            'alamat' => 'Alamat',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_selesai' => 'Tanggal Selesai',
            'desc' => 'Desc',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    public function getJenisTest()
    {
        return $this->hasOne(JenisTest::className(), ['jenis_test_id' => 'jenis_test_id']);
    }
    public function getGelombangPendaftaran()
    {
        return $this->hasOne(GelombangPendaftaran::className(), ['gelombang_pendaftaran_id' => 'gelombang_pendaftaran_id']);
    }
    public function getCreator()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }
    public function getUpdater()
    {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }
}
