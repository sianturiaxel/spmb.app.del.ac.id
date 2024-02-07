<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "t_nilai_psikotes".
 *
 * @property int $nilai_psikotes_id
 * @property int $pendaftar_id
 * @property string|null $kode_tes
 * @property string|null $kehadiran
 * @property int|null $tiu
 * @property string|null $kategori_tiu
 * @property string|null $stabilit_as_emosi
 * @property string|null $temp_kerja
 * @property string|null $ketelitian
 * @property string|null $konsistensi
 * @property string|null $daya_tahan
 * @property int|null $iq
 * @property string|null $kategori_iq
 * @property string|null $hasil
 * @property int|null $peringkat
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 */
class NilaiPsikotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $excelFile;


    public static function tableName()
    {
        return 't_nilai_psikotes';
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
            [['pendaftar_id', 'tiu', 'iq', 'peringkat'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['kode_tes', 'kehadiran', 'kategori_tiu', 'stabilit_as_emosi', 'temp_kerja', 'ketelitian', 'konsistensi', 'daya_tahan', 'kategori_iq', 'hasil', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nilai_psikotes_id' => 'Nilai Psikotes ID',
            'pendaftar_id' => 'Pendaftar ID',
            'kode_tes' => 'Kode Tes',
            'kehadiran' => 'Kehadiran',
            'tiu' => 'Tiu',
            'kategori_tiu' => 'Kategori Tiu',
            'stabilit_as_emosi' => 'Stabilit As Emosi',
            'temp_kerja' => 'Temp Kerja',
            'ketelitian' => 'Ketelitian',
            'konsistensi' => 'Konsistensi',
            'daya_tahan' => 'Daya Tahan',
            'iq' => 'Iq',
            'kategori_iq' => 'Kategori Iq',
            'hasil' => 'Hasil',
            'peringkat' => 'Peringkat',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    public function getPendaftar()
    {
        return $this->hasOne(Pendaftar::class, ['pendaftar_id' => 'pendaftar_id']);
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
