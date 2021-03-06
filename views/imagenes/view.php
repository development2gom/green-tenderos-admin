<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\EntImagenes */

$this->title = $model->id_imagen;
$this->params['breadcrumbs'][] = ['label' => 'Ent Imagenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/webAssets/js/imagenes/view.js',
    ['depends' => [AppAsset::className()]]
);
?>
<div class="ent-imagenes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_imagen], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_imagen], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <button class="js-publicar-imagen" data-id="<?= $model->id_imagen ?>" data-url="<?= Url::base() ?>">Publicar</button>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_imagen',
            'id_concurso',
            'txt_nombre',
            'txt_url:url',
            'b_habilitado',
        ],
    ]) ?>

</div>
