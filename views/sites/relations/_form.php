<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Relations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'typeid')->textInput() ?>

    <?= $form->field($model, 'regionid')->textInput() ?>

    <?= $form->field($model, 'nr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objid')->textInput() ?>

    <?= $form->field($model, 'relationid')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'statusid')->textInput() ?>

    <?= $form->field($model, 'opendate')->textInput() ?>

    <?= $form->field($model, 'closedate')->textInput() ?>

    <?= $form->field($model, 'molid')->textInput() ?>

    <?= $form->field($model, 'inventdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
