<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntImagenes */

$this->title = 'Update Ent Imagenes: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ent Imagenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_imagen, 'url' => ['view', 'id' => $model->id_imagen]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ent-imagenes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
