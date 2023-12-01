<?php

use backend\models\BerkasDaftarUlang;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\BerkasDaftarUlangSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Berkas Daftar Ulangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="berkas-daftar-ulang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Berkas Daftar Ulang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'berkas_daftar_ulang_id',
            'name',
            'desc:ntext',
            'berkas',
            'link',
            //'is_active',
            //'deleted',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BerkasDaftarUlang $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'berkas_daftar_ulang_id' => $model->berkas_daftar_ulang_id]);
                 }
            ],
        ],
    ]); ?>


</div>
