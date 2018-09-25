<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\sites\Sitesforupdate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sitesforupdate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'planedaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'realaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'juricaladdress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startdate')->textInput() ?>

    <?= $form->field($model, 'closedate')->textInput() ?>

    <?= $form->field($model, 'mol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isinventory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastinventorydate')->textInput() ?>

    <?= $form->field($model, 'typeid')->textInput() ?>

    <?= $form->field($model, 'regionid')->textInput() ?>

    <?= $form->field($model, 'nr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siteid')->textInput() ?>

    <?= $form->field($model, 'statusid')->textInput() ?>

    <?= $form->field($model, 'molid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
