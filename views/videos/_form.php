<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CatConcurso;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\EntVideos */
/* @var $form yii\widgets\ActiveForm */
$Concursovideo = CatConcurso::find()->where(['b_habilitado' => 1])->all();
?>

<?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'id_concurso')->widget(Select2::classname(), ['data' => ArrayHelper::map($Concursovideo, 'id_concurso', 'txt_nombre'), 'language' => 'es', 'options' => ['placeholder' => 'Seleccionar concurso'], 'pluginOptions' => ['allowClear' => true], ])->label("Concurso"); ?> 

        </div>

        <div class="col-12">
            <?= $form->field($model, 'txt_nombre')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-12">
            <?= $form->field($model, 'fileUpload')->fileInput(['data-plugin' => 'dropify']) ?>
            <!-- <input type="file" class="js-input-file" id="input-file-now" data-plugin="dropify" data-allowed-file-extensions="" data-default-file="" /> -->
        </div>
        
        <div class="col-12 col-actions">
            <?= Html::submitButton(
                '<span class="ladda-label"><span><i class="icon wb-download" aria-hidden="true"></i> GUARDAR </span></span>',
                [
                    'class' => 'btn btn-animate btn-animate-side btn-primary ladda-button',
                    "data-style" => "zoom-in"
                ]
            ) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>