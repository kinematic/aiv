<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\people\People */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="people-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secondnameid')->textInput() ?>

    <?= $form->field($model, 'patronymicnameid')->textInput() ?>

    <?= $form->field($model, 'companyid')->textInput() ?>

    <?= $form->field($model, 'positionid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
