<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntImagenes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ent-imagenes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_concurso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'b_habilitado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
