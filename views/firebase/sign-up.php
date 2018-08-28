<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */

$this->title = 'Crear cuenta';
$this->params['classBody'] = "page-login-v3 layout-full";
echo $this->render("core");
?>

<script>

</script>

<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div class="panel">
      <div class="panel-body">
          <div class="brand text-center">
            
            <h2 class="brand-text font-size-18 text-center"><?= Html::encode($this->title) ?></h2>
          </div>
          <?php $form = ActiveForm::begin([
            'id' => 'form-ajax',
						//'options' => ['class' => 'form-horizontal'],
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
          ]); ?>


          <?= $form->field($model, 'txt_username')->textInput(['maxlength' => true, 'placeholder' => 'Nombre'])->label(false) ?>

          <?= $form->field($model, 'txt_apellido_paterno')->textInput(['maxlength' => true, 'placeholder' => 'Apellido paterno'])->label(false) ?>

          <?= $form->field($model, 'txt_email')->textInput(['maxlength' => true, 'placeholder' => 'Email'])->label(false) ?>

          <?= $form->field($model, 'repeatEmail')->textInput(['maxlength' => true, 'placeholder' => 'Repetir email'])->label(false) ?>
          
          <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Contraseña'])->label(false) ?>
          
          <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true, 'placeholder' => 'Repetir contraseña'])->label(false) ?>

          <div class="form-group">
              <?= Html::submitButton($model->isNewRecord ? 'Registrarme' : 'Actualizar información', ['class' => "btn btn-success btn-block btn-lg"]) ?>
          </div>

    <?php ActiveForm::end(); ?>
          <p class="text-center">¿Tienes una cuenta? <a href="<?= Url::base() ?>/login">Ingresa</a></p>
      </div>
    </div>
  </div>
</div>
