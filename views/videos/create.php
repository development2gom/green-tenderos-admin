<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntVideos */

$this->title = 'Subir Videos';
$this->params['breadcrumbs'][] = ['label' => 'Ent Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ent-videos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
