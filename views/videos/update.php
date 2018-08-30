<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntVideos */

$this->title = 'Update Ent Videos: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ent Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_video, 'url' => ['view', 'id' => $model->id_video]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ent-videos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
