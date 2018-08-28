<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Recuperar contraseña';
$this->params['classBody'] = "page-login-v3 layout-full login-page";
?>
<div class="panel">
	<div class="panel-body">

		<?php if (Yii::$app->session->hasFlash('success')): ?>
			<div class="alert dark alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
				<?= Yii::$app->session->getFlash('success') ?>
			</div>
		<?php endif; ?>

		<?php 
		$form = ActiveForm::begin([
			'id' => 'login-form',
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

		<?= $form->field($model, 'username')->textInput(["class"=>"form-control"]) ?>

		<div class="form-group clearfix">
			<a class="float-right" href="<?=Url::base()?>/sign-up">Necesito una cuenta</a>
		</div>

		<?= Html::submitButton('<span class="ladda-label">Recuperar contraseña</span>', ["data-style"=>"zoom-in", 'class' => 'btn btn-primary btn-block btn-lg mt-20 ladda-button', 'name' => 'login-button'])
        ?>
        <div class="form-group clearfix  text-center mt-20">
			<a href="<?=Url::base()?>/login">Iniciar sesión</a>
		</div>
        


		<?php ActiveForm::end(); ?>

		<div class="ayuda-soporte">
			<span>¿Necesitas ayuda? escribe a:</span>
			<a class="no-redirect login-link" href="mailto:soporte@2gom.com.mx?Subject=Solicitud%de%Soporte">soporte@2gom.com.mx</a>
		</div>

	</div>
</div>
