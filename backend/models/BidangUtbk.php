<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "t_r_bidang_utbk".
 *
 * @property int $bidang_utbk_id
 * @property int $kategori_bidang_utbk_id
 * @property string $name
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 *
 * @property TRKategoriBidangUtbk $kategoriBidangUtbk
 * @property TNilaiUtbk[] $tNilaiUtbks
 */
class BidangUtbk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_r_bidang_utbk';
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
            [['kategori_bidang_utbk_id', 'name'], 'required'],
            [['kategori_bidang_utbk_id', 'deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 125],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['kategori_bidang_utbk_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriBidangUtbk::class, 'targetAttribute' => ['kategori_bidang_utbk_id' => 'kategori_bidang_utbk_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bidang_utbk_id' => 'Bidang Utbk ID',
            'kategori_bidang_utbk_id' => 'Kategori Bidang Utbk ID',
            'name' => 'Name',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[KategoriBidangUtbk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriBidangUtbk()
    {
        return $this->hasOne(KategoriBidangUtbk::class, ['kategori_bidang_utbk_id' => 'kategori_bidang_utbk_id']);
    }
    public function getCreator()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }

    public function getUpdater()
    {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[TNilaiUtbks]].
     *
     * @return \yii\db\ActiveQuery
     */
}
