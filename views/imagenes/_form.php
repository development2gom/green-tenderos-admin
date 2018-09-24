<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CatConcurso;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\EntImagenes */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-12">
            <?= $form->field($model, 'id_concurso')->dropDownList(ArrayHelper::map(CatConcurso::find()->where(['b_habilitado'=>1])->OrderBy('txt_nombre ASC')->all(), 'id_concurso', 'txt_nombre'), ['prompt'=>'Seleccionar concurso']) ?>   
        </div>
        <div class="col-12">
            <?= $form->field($model, 'txt_nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-12">
        <?= $form->field($model, 'fileUpload')->fileInput(['accept'=>'image/*','data-plugin'=>'dropify']) ?>
           
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
