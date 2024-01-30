<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "t_waktu_pengumuman".
 *
 * @property int $waktu_pengumuman_id
 * @property int $gelombang_pendaftaran_id
 * @property int $jenis_test_id
 * @property string|null $tanggal_mulai
 * @property string|null $tanggal_akhir
 * @property string|null $catatan
 * @property string|null $created_by
 * @property string|null $created_date
 * @property string|null $updated_by
 * @property string|null $updated_date
 * @property string|null $deleted_by
 * @property string|null $deleted_date
 */
class WaktuPengumuman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_waktu_pengumuman';
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
            [['gelombang_pendaftaran_id', 'jenis_test_id'], 'required'],
            [['gelombang_pendaftaran_id', 'jenis_test_id'], 'integer'],
            [['tanggal_mulai', 'tanggal_akhir', 'created_date', 'updated_date', 'deleted_date'], 'safe'],
            [['catatan', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'waktu_pengumuman_id' => 'Waktu Pengumuman ID',
            'gelombang_pendaftaran_id' => 'Gelombang Pendaftaran ID',
            'jenis_test_id' => 'Jenis Test ID',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_akhir' => 'Tanggal Akhir',
            'catatan' => 'Catatan',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'deleted_by' => 'Deleted By',
            'deleted_date' => 'Deleted Date',
        ];
    }
    public function getGelombangPendaftaran()
    {
        return $this->hasOne(GelombangPendaftaran::class, ['gelombang_pendaftaran_id' => 'gelombang_pendaftaran_id']);
    }
    public function getJenisTest()
    {
        return $this->hasOne(JenisTest::class, ['jenis_test_id' => 'jenis_test_id']);
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
