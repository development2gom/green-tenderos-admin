<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntImagenes */

$this->title = 'Subir imagen';
$this->params['breadcrumbs'][] = ['label' => 'Ent Imagenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ent-imagenes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
