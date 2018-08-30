<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntImagenes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ent-imagenes-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-6">
        <?= $form->field($model, 'id_concurso')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-6">
        <?= $form->field($model, 'txt_nombre')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-6">
        <?= $form->field($model, 'fileUpload')->fileInput(['accept'=>'image/*']) ?>
    </div>
   
        

        <div class="col-12">
            <?= Html::submitButton('Guaradar', ['class' => 'btn btn-success']) ?>
        </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
