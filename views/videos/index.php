<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\grid\GridView;
use app\models\EntVideos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntVideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;


$this->registerCssFile(
    '@web/webAssets/templates/classic/global/vendor/magnific-popup/magnific-popup.css',
    ['depends' => [AppAsset::className()]]
);
$this->registerCssFile(
  '@web/webAssets/templates/classic/topbar/assets/examples/css/pages/gallery.css',
  ['depends' => [AppAsset::className()]]
);

$this->registerJsFile(
  '@web/webAssets/templates/classic/global/vendor/magnific-popup/jquery.magnific-popup.min.js',
  ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
  '@web/webAssets/templates/classic/global/vendor/isotope/isotope.pkgd.min.js',
  ['depends' => [AppAsset::className()]]
);

$this->registerJsFile(
    '@web/webAssets/templates/classic/global/js/Plugin/asscrollable.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
  '@web/webAssets/templates/classic/global/js/Plugin/slidepanel.js',
  ['depends' => [AppAsset::className()]]
);

$this->registerJsFile(
    '@web/webAssets/templates/classic/global/js/Plugin/switchery.js',
    ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
  '@web/webAssets/templates/classic/global/js/Plugin/filterable.js',
  ['depends' => [AppAsset::className()]]
);
$this->registerJsFile(
    '@web/webAssets/templates/classic/topbar/assets/examples/js/pages/gallery.js',
    ['depends' => [AppAsset::className()]]
);

$this->registerCssFile(
    '@web/webAssets/templates/classic/global/vendor/toastr/toastr.css',
    ['depends' => [\app\assets\AppAsset::className()]]
  );
  $this->registerCssFile(
    '@web/webAssets/templates/classic/topbar/assets/examples/css/advanced/toastr.css',
    ['depends' => [\app\assets\AppAsset::className()]]
  );
  
  $this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/toastr/toastr.js',
    ['depends' => [\app\assets\AppAsset::className()]]
  );
  $this->registerJsFile(
    '@web/webAssets/templates/classic/global/js/Plugin/toastr.js',
    ['depends' => [\app\assets\AppAsset::className()]]
  );
  
  $this->registerJsFile(
    '@web/webAssets/js/videos/index.js',
    ['depends' => [\app\assets\AppAsset::className()]]
  );
?>

<div class="page-gallery">

  <div class="page-gallery-head">

    <div class="page-gallery-header">
      <div class="page-gallery-header-title">
        <h2><?= Html::encode($this->title) ?></h2>
      </div>
      <div class="page-gallery-header-actions">
        <?= Html::a('<span><i class="icon wb-plus" aria-hidden="true"></i>Agregar vídeo</span>', ['create'], ['class' => 'btn btn-animate btn-animate-vertical btn-primary no-pjax']) ?>
      </div>
    </div>

    <div class="page-gallery-head-filter">
      <ul class="nav nav-tabs nav-tabs-line" role="tablist" id="exampleFilter">

        <li class="nav-item" role="presentation">
            <a class="active nav-link" href="#" aria-controls="exampleList" aria-expanded="true" role="tab" data-filter="*">All</a>
        </li>

        <?php
        foreach($concursos as $concurso){
        ?>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="#" aria-expanded="false" role="tab" data-filter="<?= $concurso->id_concurso ?>"><?= $concurso->txt_nombre ?></a>
            </li>
        <?php
        }
        ?>

      </ul>
    </div>
  </div>

  <div class="page-gallery-body">

    <div class="row js-grid" data-plugin="filterable" data-filters="#exampleFilter">
        
        <?php
        foreach ($concursos as $concurso){
            foreach ($videos as $video){
        ?>
                <?php if($concurso->id_concurso == $video->id_concurso){ ?>
                    <div class="col-md-4 js-video-<?= $video->id_video ?>" data-type="<?= $concurso->id_concurso ?>">
                        <div class="card card-shadow">
                            <figure class="card-img-top overlay-hover overlay">
                                <video class="overlay-video overlay-figure overlay-scale" style="background-image: url('http://img.youtube.com/vi/<?= EntVideos::getIdVideoYoutube($video->txt_url) ?>/mqdefault.jpg') ">
                                    <source src="http://img.youtube.com/vi/<?= EntVideos::getIdVideoYoutube($video->txt_url) ?>/mqdefault.jpg">
                                    <!-- <source src="video.ogg" type="video/ogg">
                                    <source src="video.webm" type="video/webm"> -->
                                    Tu navegar no soporta la etiqueta de video.
                                </video> 

                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                    <a class="icon wb-search mfp-iframe" href="<?= $video->txt_url ?>"></a>
                                    <a class="icon wb-trash js-delete-video" href="#" data-url="<?= Url::base() ?>" data-id=<?= $video->id_video ?> ></a>
                                    <a class="icon wb-pencil" href="<?= Url::base() . "/videos/update/" . $video->id_video ?>"></a>
                                    <p class="card-block"><?= $video->txt_nombre ?></p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>    
        <?php
                }
            }
        }
        ?>
    </div>
  
  </div>

</div>