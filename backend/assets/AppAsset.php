<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'adminLTE/fontawesome-free/css/all.min.css',
        'adminLTE/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'adminLTE/icheck-bootstrap/icheck-bootstrap.min.css',
        'adminLTE/jqvmap/jqvmap.min.css',
        'adminLTE/dist/css/adminlte.min.css',
        'adminLTE/overlayScrollbars/css/OverlayScrollbars.min.css',
        'adminLTE/summernote/summernote-bs4.min.css',
        'adminLTE/daterangepicker/daterangepicker.css',
        'adminLTE/datatables-bs4/css/dataTables.bootstrap4.min.css',
        'adminLTE/datatables-responsive/css/responsive.bootstrap4.min.css',
        'adminLTE/datatables-buttons/css/buttons.bootstrap4.min.css',
        'adminLTE/fullcalendar/main.css',
        'adminLTE/select2/css/select2.min.css',
        'adminLTE/select2-bootstrap4-theme/select2-bootstrap4.min.css',
        'adminLTE/toastr/toastr.min.css',
        'adminLTE/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'
    ];
    public $js = [
        //'adminLTE/jquery.min.js',
        'adminLTE/jquery/jquery.min.js',
        'adminLTE/jquery-ui/jquery-ui.min.js',
        'adminLTE/bootstrap/js/bootstrap.bundle.min.js',
        'adminLTE/chart.js/Chart.min.js',
        'adminLTE/sparklines/sparkline.js',
        'adminLTE/jqvmap/jquery.vmap.min.js',
        'adminLTE/jquery-knob/jquery.knob.min.js',
        'adminLTE/moment/moment.min.js',
        'adminLTE/daterangepicker/daterangepicker.js',
        "adminLTE/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js",
        'adminLTE/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'adminLTE/summernote/summernote-bs4.min.js',
        'adminLTE/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'adminLTE/dist/js/adminlte.js',
        //'adminLTE/dist/js/demo.js',
        'adminLTE/dist/js/pages/dashboard.js',
        'adminLTE/datatables/jquery.dataTables.min.js',
        'adminLTE/datatables-bs4/js/dataTables.bootstrap4.min.js',
        'adminLTE/datatables-responsive/js/dataTables.responsive.min.js',
        'adminLTE/datatables-responsive/js/responsive.bootstrap4.min.js',
        'adminLTE/datatables-buttons/js/dataTables.buttons.min.js',
        'adminLTE/datatables-buttons/js/buttons.bootstrap4.min.js',
        'adminLTE/jszip/jszip.min.js',
        'adminLTE/pdfmake/pdfmake.min.js',
        'adminLTE/pdfmake/vfs_fonts.js',
        'adminLTE/datatables-buttons/js/buttons.html5.min.js',
        'adminLTE/datatables-buttons/js/buttons.print.min.js',
        'adminLTE/datatables-buttons/js/buttons.colVis.min.js',
        'adminLTE/fullcalendar/main.js',
        'adminLTE/select2/js/select2.full.min.js',
        'adminLTE/sweetalert2/sweetalert2.min.js',
        'adminLTE/toastr/toastr.min.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
