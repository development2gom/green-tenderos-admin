<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model app\models\EntVideos */

$this->title = $model->id_video;
$this->params['breadcrumbs'][] = ['label' => 'Ent Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/webAssets/js/videos/view.js',
    ['depends' => [AppAsset::className()]]
);
?>
<div class="ent-videos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_video], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_video], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <button class="js-publicar-video" data-id="<?= $model->id_video ?>" data-url="<?= Url::base() ?>">Publicar</button>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_video',
            'id_concurso',
            'txt_nombre',
            'txt_url:url',
            'b_habilitado',
        ],
    ]) ?>

</div>
