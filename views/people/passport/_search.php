<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\people\PassportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="passport-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'manid') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'issued') ?>

    <?= $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'placebirth') ?>

    <?php // echo $form->field($model, 'registration') ?>

    <?php // echo $form->field($model, 'residence') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
