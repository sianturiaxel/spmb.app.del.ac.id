<?php

use backend\assets\AppAsset;
use common\widgets\Alert;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <?= $this->render('header.php'); ?>
        <?= $this->render('sidebar.php'); ?>

        <div class="content-wrapper ml-7">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?> <!-- Konten utama -->
        </div>

        <?= $this->render('footer.php'); ?> <!-- Footer -->
    </div>

    <?php $this->endBody() ?>
</body>


</html>
<?php $this->endPage(); ?>

<style>
    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content-wrapper {
        flex: 1;
        padding: 20px;
    }

    header,
    .sidebar,
    footer {
        padding: 15px;
        /* Warna latar belakang untuk header, sidebar, dan footer */
    }

    /* Gaya tambahan untuk header dan footer */
    header,
    footer {
        text-align: center;
        font-weight: bold;
    }
</style>