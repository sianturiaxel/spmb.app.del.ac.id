<?php

use backend\models\NilaiAkademik;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\NilaiAkademikSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Nilai Akademiks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nilai-akademik-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Nilai Akademik', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nilai_akademik_id',
            'pendaftar_id',
            'mat_benar',
            'mat_salah',
            'ing_benar',
            //'ing_salah',
            //'tpa_benar',
            //'tpa_salah',
            //'total_kosong',
            //'mp_tinggi',
            //'mp_rendah',
            //'perbandingan_mat_ing',
            //'jumlah_soal',
            //'hasil_score',
            //'scala_score',
            //'usulan_panitia',
            //'pilihan1',
            //'pilihan2',
            //'pilihan3',
            //'hasil_akhir_pilihan',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'deleted_at',
            //'deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, NilaiAkademik $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'nilai_akademik_id' => $model->nilai_akademik_id]);
                }
            ],
        ],
    ]); ?>

    <form id="excel-upload-form" method="post" enctype="multipart/form-data">
        <input type="file" name="excel_file" id="excel-file" accept=".xls, .xlsx" />
        <button type="submit">Upload dan Proses</button>
    </form>
</div>