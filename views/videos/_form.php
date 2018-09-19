<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CatConcurso;

/* @var $this yii\web\View */
/* @var $model app\models\EntVideos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ent-videos-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
        <div class="col-6">
        <?= $form->field($model, 'id_concurso')->dropDownList(ArrayHelper::map(CatConcurso::find()->where(['b_habilitado'=>1])->OrderBy('txt_nombre ASC')->all(), 'id_concurso', 'txt_nombre'), ['prompt'=>'Seleccionar concurso']) ?>   
        </div>
        <div class="col-6">
            <?= $form->field($model, 'txt_nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'fileUpload')->fileInput() ?>
        </div>
        
        
        <div class="col-12">
            <?= Html::submitButton('GUARDAR', ['class' => 'btn btn-success']) ?>
        </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
