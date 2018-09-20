<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CatConcurso;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\EntImagenes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-datos-cont-actions">

    <button type="button" class="btn btn-success btn-outline">
        <i class="icon ion-ios-color-wand" aria-hidden="true"></i>
    </button>
    <button type="button" class="btn btn-danger btn-outline">
        <i class="icon ion-ios-trash" aria-hidden="true"></i>
    </button>
</div>

<?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-12">
            <?= $form->field($model, 'id_concurso')->dropDownList(ArrayHelper::map(CatConcurso::find()->where(['b_habilitado'=>1])->OrderBy('txt_nombre ASC')->all(), 'id_concurso', 'txt_nombre'), ['prompt'=>'Seleccionar concurso']) ?>   
        </div>
        <div class="col-12">
            <?= $form->field($model, 'txt_nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'fileUpload')->fileInput(['accept'=>'image/*']) ?>
            <input type="file" class="js-input-file" id="input-file-now" data-plugin="dropify" data-allowed-file-extensions="" data-default-file="" />
        </div>

        <div class="col-12 col-actions">
            <?= Html::submitButton('GUARDAR', ['class' => 'btn btn-primary']) ?>
        </div>

    </div>

<?php ActiveForm::end(); ?>
