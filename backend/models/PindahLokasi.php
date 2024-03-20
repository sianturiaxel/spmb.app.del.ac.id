<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_pindah_lokasi".
 *
 * @property int $pindah_lokasi_id
 * @property int $pendaftar_id
 * @property int $lokasi_saat_ini
 * @property string|null $lokasi_tujuan
 * @property string|null $file_pendukung
 * @property string|null $status
 * @property string|null $catatan
 * @property string|null $created_by
 * @property string|null $created_date
 * @property string|null $updated_by
 * @property string|null $updated_date
 * @property string|null $deleted_by
 * @property string|null $deleted_date
 */
class PindahLokasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_pindah_lokasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pendaftar_id', 'lokasi_saat_ini'], 'required'],
            [['pendaftar_id', 'lokasi_saat_ini'], 'integer'],
            [['created_date', 'updated_date', 'deleted_date'], 'safe'],
            [['lokasi_tujuan', 'file_pendukung', 'status', 'catatan', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pindah_lokasi_id' => 'Pindah Lokasi ID',
            'pendaftar_id' => 'Pendaftar ID',
            'lokasi_saat_ini' => 'Lokasi Saat Ini',
            'lokasi_tujuan' => 'Lokasi Tujuan',
            'file_pendukung' => 'File Pendukung',
            'status' => 'Status',
            'catatan' => 'Catatan',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'deleted_by' => 'Deleted By',
            'deleted_date' => 'Deleted Date',
        ];
    }
}
