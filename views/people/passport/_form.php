<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\people\Passport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="passport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'manid')->textInput() ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issued')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'placebirth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residence')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
