<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\EntImagenes;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntImagenesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imagenes';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(
    '@web/webAssets/templates/classic/topbar/assets/examples/css/pages/gallery.css',
    ['depends' => [\app\assets\AppAsset::className()]]
  );

$this->registerCssFile(
    '@web/webAssets/templates/classic/global/vendor/magnific-popup/magnific-popup.css',
    ['depends' => [\app\assets\AppAsset::className()]]
);

$this->registerCssFile(
    '@web/webAssets/templates/classic/topbar/assets/examples/css/pages/gallery.css',
    ['depends' => [\app\assets\AppAsset::className()]]
);

$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/isotope/isotope.pkgd.min.js',
    ['depends' => [\app\assets\AppAsset::className()]]
);



$this->registerJsFile(
    '@web/webAssets/templates/classic/global/vendor/magnific-popup/jquery.magnific-popup.min.js',
    ['depends' => [\app\assets\AppAsset::className()]]
);

$this->registerJsFile(
    '@web/webAssets/templates/classic/global/js/Plugin/filterable.js',
    ['depends' => [\app\assets\AppAsset::className()]]
);

$this->registerJsFile(
    '@web/webAssets/templates/classic/topbar/assets/examples/js/pages/gallery.js',
    ['depends' => [\app\assets\AppAsset::className()]]
);
  




?>

<div class="page-header page-header-bordered page-header-tabs">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
        <li class="breadcrumb-item active">Pages</li>
      </ol>
      <h1 class="page-title">Gallery</h1>
      <div class="page-header-actions">
        <a class="btn btn-sm btn-inverse btn-round" href="https://github.com/metafizzy/isotope"
        target="_blank">
          <i class="icon wb-link" aria-hidden="true"></i>
          <span class="hidden-sm-down">Official Website</span>
        </a>
      </div>
      <ul class="nav nav-tabs nav-tabs-line" role="tablist" id="exampleFilter">
        <li class="nav-item" role="presentation">
          <a class="active nav-link" href="#" aria-controls="exampleList" aria-expanded="true"
          role="tab" data-filter="*">All</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="#" aria-expanded="false" role="tab" data-filter="object">Object</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="#" aria-expanded="false" role="tab" data-filter="city">City</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="#" aria-expanded="false" role="tab" data-filter="animal">Animal</a>
        </li>
      </ul>
    </div>
    <div class="page-content">
      <ul class="blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-md-2" data-plugin="filterable"
      data-filters="#exampleFilter">
        <li data-type="animal">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">Animal Horse</h4>
            </div>
          </div>
        </li>
        <li data-type="object">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">Object Coffee</h4>
            </div>
          </div>
        </li>
        <li data-type="object">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">Object Cup</h4>
            </div>
          </div>
        </li>
        <li data-type="city">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">City Nature</h4>
            </div>
          </div>
        </li>
        <li data-type="scenery">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">City Station</h4>
            </div>
          </div>
        </li>
        <li data-type="city">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">City Leaf</h4>
            </div>
          </div>
        </li>
        <li data-type="animal">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">Animal Bird</h4>
            </div>
          </div>
        </li>
        <li data-type="city">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">City Street</h4>
            </div>
          </div>
        </li>
        <li data-type="animal">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">Animal Nature</h4>
            </div>
          </div>
        </li>
        <li data-type="city">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">City Night</h4>
            </div>
          </div>
        </li>
        <li data-type="object">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">Object Book</h4>
            </div>
          </div>
        </li>
        <li data-type="object">
          <div class="card card-shadow">
            <figure class="card-img-top overlay-hover overlay">
              <img class="overlay-figure overlay-scale" src="../../../global/photos/placeholder.png"
              alt="...">
              <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                <a class="icon wb-search" href="../../../global/photos/placeholder.png"></a>
              </figcaption>
            </figure>
            <div class="card-block">
              <h4 class="card-title">Object Grape</h4>
            </div>
          </div>
        </li>
      </ul>
    </div>


<div class="ent-imagenes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva imagen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_imagen',
            // 'txt_nombre',
            [
                'attribute' => 'txt_nombre',
                'format' => 'raw',
                'value' => function ($model){

                    return Html::a($model->txt_nombre, 'view/'.$model->id_imagen);
                },
            ],
            // 'txt_url:url',
            // 'b_habilitado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
