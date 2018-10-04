<?php
use yii\helpers\Url;
use app\assets\AppAsset;

$this->title = 'Cargar exel';
$this->registerJsFile(
    '@web/webAssets/js/site/importar.js',
    ['depends' => [AppAsset::className()]]
);

// $this->registerCssFile(
//     '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload.css',
//     ['depends' => [AppAsset::className()]]
// );
$this->registerCssFile(
    '@web/webAssets/templates/classic/global/vendor/dropify/dropify.css',
    ['depends' => [AppAsset::className()]]
);

// $this->registerJsFile(
//     '@web/webAssets/templates/classic/global/vendor/blueimp-load-image/load-image.all.min.js',
//     ['depends' => [AppAsset::className()]]
// );
// $this->registerJsFile(
//     '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload.js',
//     ['depends' => [AppAsset::className()]]
// );
// $this->registerJsFile(
//     '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-process.js',
//     ['depends' => [AppAsset::className()]]
// );
// $this->registerJsFile(
//     '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-image.js',
//     ['depends' => [AppAsset::className()]]
// );
// $this->registerJsFile(
//     '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-audio.js',
//     ['depends' => [AppAsset::className()]]
// );
// $this->registerJsFile(
//     '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-video.js',
//     ['depends' => [AppAsset::className()]]
// );
// $this->registerJsFile(
//     '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-validate.js',
//     ['depends' => [AppAsset::className()]]
// );
// $this->registerJsFile(
//     '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-ui.js',
//     ['depends' => [AppAsset::className()]]
// );
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/dropify/dropify.min.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/js/Plugin/dropify.js',
    ['depends' => [AppAsset::className()]]
);
// $this->registerJsFile(
//     '@web/webAssets/templates/classic/topbar/assets/examples/js/forms/uploads.js',
//     ['depends' => [AppAsset::className()]]
// );

?>

<div class="page-datos">

    <div class="page-title">
        <h2>Cargar archivo excel</h2>
        <hr>
    </div>

    <div class="page-datos-cont">

        <!-- <div class="page-datos-cont-actions">

            <button type="button" class="btn btn-success btn-outline">
                <i class="icon ion-ios-color-wand" aria-hidden="true"></i>
            </button>
            <button type="button" class="btn btn-danger btn-outline">
                <i class="icon ion-ios-trash" aria-hidden="true"></i>
            </button>
        </div> -->

        <form>
            <input type="file" class="js-input-file" name="file-import" data-plugin="dropify" data-url="<?= Url::base() ?>"/>
        </form>
        
    </div>

</div>