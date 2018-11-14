<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['classBody'] = "page-login-v3 layout-full login-page";

?>



<div class="panel">
	<div class="panel-body">
		
		<h2>
            <img src="<?=Url::base()?>/webAssets/images/logo-gepp-blue.png" alt="">
        </h2>


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
	]);
	?>

		<?= $form->field($model, 'username')->textInput(["class" => "form-control"]) ?>

		<?= $form->field($model, 'password')->passwordInput(["class" => "form-control"]) ?>

		<div class="form-group olvide-contrasena">
			
		</div>

		<div class="form-group form-group-actions">
			<?= Html::submitButton('<span class="ladda-label">INGRESAR</span>', ["data-style" => "zoom-in", 'class' => 'btn btn-secondary btn-block btn-lg mt-20 ladda-button', 'name' => 'login-button']); ?>
		</div>

		<!--<div class="form-group necesito-cuenta">
			<a class="login-link" href="<?= Url::base() ?>/sign-up">Necesito una cuenta</a>
		</div>-->

		<?php ActiveForm::end(); ?>


		<div class="ayuda-soporte">
			
		</div>
	</div>
</div>
