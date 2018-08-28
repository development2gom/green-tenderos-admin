<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\Constantes;


/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */

// $this->title = 'Crear usuario';
// $this->params['breadcrumbs'][] = [
//     'label' => '<i class="icon pe-users"></i> Usuarios', 
//     'encode' => false,
//     'template'=>'<li class="breadcrumb-item">{link}</li>',
//     'url' => ['index'], 
//   ];
// $this->params['breadcrumbs'][] = [
//     'label' => '<i class="icon wb-plus"></i>'.$this->title, 
//     'encode' => false,
//     'template'=>'<li class="breadcrumb-item">{link}</li>', 
//   ];

  $this->title = 'Agregar Usuario';
  $this->params['classBody'] = "site-navbar-small";  

  $this->params['classBody'] = "site-navbar-small site-menubar-hide usuarios-create";


  $this->registerJsFile(
    '@web/webAssets/js/sign-up.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
  );

  $this->registerCssFile(
    '@web/webAssets/css/signUp.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]
  );
?>

<div class="list-head">

  

  </div>

  <div class="panel panel-default">
  <div class="panel-body">

      <?= $this->render('_form', [
          'model' => $model,
          'roles'=>$roles,
          'supervisores'=>$supervisores
      ]) ?>

  </div>
</div>
