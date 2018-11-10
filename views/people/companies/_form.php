<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\people\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-md-3">
		    <?= $form->field($model, 'simplename')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-3">
		    <?= $form->field($model, 'officialname')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
