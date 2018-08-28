<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
    'id' => 'form-ajax',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'fieldConfig' => [
        "template" => "{input}{label}{error}",
        "options" => [
            "class" => "form-group form-material floating",
            "data-plugin" => "formMaterial"
        ],
        "labelOptions" => [
            "class" => "floating-label"
        ]
    ]
]);?>

    <?= $form->field($model, 'image')->fileInput(["class"=>"hide"])->label(false) ?> 


    <?= $form->field($model, 'txt_username')->textInput(["class" => "form-control"]) ?>

    <?= $form->field($model, 'txt_apellido_paterno')->textInput(["class" => "form-control"]) ?>

    <?= $form->field($model, 'txt_email')->textInput(["class" => "form-control"]) ?>

    <?= $form->field($model, 'repeatEmail')->textInput(["class" => "form-control"]) ?>

    <?= $form->field($model, 'password')->passwordInput(["class" => "form-control"]) ?>

    <?= $form->field($model, 'repeatPassword')->passwordInput(["class" => "form-control"]) ?>


    <div class="form-group form-group-actions">
        <?= Html::submitButton($model->isNewRecord ? 'Registrarme' : 'Actualizar información', ['class' => "btn btn-primary btn-block btn-lg"]) ?>
	</div>

    <div class="form-group necesito-cuenta">
        ¿Tienes una cuenta? <a href="<?=Url::base()?>/login">Ingresa</a>
    </div>


<?php ActiveForm::end(); ?>

