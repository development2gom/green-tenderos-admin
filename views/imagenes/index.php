<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\EntImagenes;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntImagenesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imagenes';
$this->params['breadcrumbs'][] = $this->title;
?>
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
