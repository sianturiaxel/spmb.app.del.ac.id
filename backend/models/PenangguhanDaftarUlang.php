<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_penangguhan_daftar_ulang".
 *
 * @property int $penangguhan_daftar_ulang_id
 * @property int $calon_mahasiswa_id
 * @property float|null $total_ditangguhkan
 * @property float|null $total_bayar
 * @property string|null $tanggal_penangguhan
 * @property int|null $approve_panitia
 * @property int|null $approve_keuangan
 * @property string|null $catatan
 * @property string|null $created_by
 * @property string|null $created_date
 * @property string|null $updated_by
 * @property string|null $updated_date
 * @property string|null $deleted_by
 * @property string|null $deleted_date
 */
class PenangguhanDaftarUlang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_penangguhan_daftar_ulang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['calon_mahasiswa_id'], 'required'],
            [['calon_mahasiswa_id', 'approve_panitia', 'approve_keuangan'], 'integer'],
            [['total_ditangguhkan', 'total_bayar'], 'number'],
            [['tanggal_penangguhan', 'created_date', 'updated_date', 'deleted_date'], 'safe'],
            [['catatan', 'created_by', 'updated_by', 'deleted_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'penangguhan_daftar_ulang_id' => 'Penangguhan Daftar Ulang ID',
            'calon_mahasiswa_id' => 'Calon Mahasiswa ID',
            'total_ditangguhkan' => 'Total Ditangguhkan',
            'total_bayar' => 'Total Bayar',
            'tanggal_penangguhan' => 'Tanggal Penangguhan',
            'approve_panitia' => 'Approve Panitia',
            'approve_keuangan' => 'Approve Keuangan',
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
