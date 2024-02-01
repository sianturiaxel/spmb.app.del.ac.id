<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\BerkasDaftarUlang $model */

$this->title = 'Berkas Daftar Ulang Detail';
$this->params['breadcrumbs'][] = ['label' => 'Berkas Daftar Ulangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="berkas-daftar-ulang container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="berkas-daftar-ulang">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'berkas_daftar_ulang_id',
                            'name',
                            'desc:ntext',
                            'link',
                            [
                                'attribute' => 'is_active',
                                'value' => function ($model) {
                                    return $model->is_active == 1 ? 'Aktif' : 'Tidak Aktif';
                                },
                            ],
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