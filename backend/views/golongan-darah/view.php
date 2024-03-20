<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var backend\models\GolonganDarah $model */

$this->title = 'Golong Darah Detail';
$this->params['breadcrumbs'][] = ['label' => 'Golongan Darah', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="golongan-darah-view container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="golongan-darah-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'golongan_darah_id',                   
                            'desc',
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