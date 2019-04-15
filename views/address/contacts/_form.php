<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
	if(!isset($model->objid)) $model->objid = $site->objid;
	echo $form->field($model, 'objid')->hiddenInput()->label(false);
	?>
	<div class='row'>
		<div class='col-md-4'>
			<?= $form->field($model, 'contact')->textInput(['maxlength' => true])->label('контакт (тел. или email)') ?>

			<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
