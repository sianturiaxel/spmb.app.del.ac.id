<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\SekolahDapodik $model */

$this->title = 'Sekolah Dapodik Detail';
$this->params['breadcrumbs'][] = ['label' => 'Sekolah Dapodik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sekolah-dapodik-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="kode-ujian-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'id',
                            'id_dapodik',
                            'npsn',
                            'kode_prop',
                            'propinsi',
                            'kode_kab_kota',
                            'kabupaten_kota',
                            'kode_kec',
                            'kecamatan',
                            'bentuk',
                            'sekolah',
                            'status',
                            'alamat_jalan',
                            'lintang',
                            'bujur',
                            'jumlah_siswa_lk',
                            'jumlah_siswa_pr',
                            'telp',
                            'fax',


                        ],
                    ]) ?>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <?= Html::a('Kembali', Url::to(['index']), ['class' => 'btn btn-warning']) ?>
                </div>
            </div>

        </div>

    </div>
</div>