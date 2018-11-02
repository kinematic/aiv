<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\letters\Lists */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lists-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'letterid')->textInput() ?>

    <?= $form->field($model, 'manid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
