<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;


/* @var $this yii\web\View */
/* @var $model app\models\EntVideos */

$this->title = 'Subir Videos';
$this->params['breadcrumbs'][] = ['label' => 'Ent Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$this->registerCssFile(
    '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload.css',
    ['depends' => [AppAsset::className()]]
);
$this->registerCssFile(
    '@web/webAssets/templates/classic/global/vendor/dropify/dropify.css',
    ['depends' => [AppAsset::className()]]
);

$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/blueimp-load-image/load-image.all.min.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-process.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-image.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-audio.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-video.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-validate.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/blueimp-file-upload/jquery.fileupload-ui.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/dropify/dropify.min.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/global/js/Plugin/dropify.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/topbar/assets/examples/js/forms/uploads.js',
    ['depends' => [AppAsset::className()]]
);
?>

<div class="page-datos">

    <div class="page-title">
        <h2><?= Html::encode($this->title) ?></h2>
        <hr>
    </div>

    <div class="page-datos-cont">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        
    </div>

</div>
