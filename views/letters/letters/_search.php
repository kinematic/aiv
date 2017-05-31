<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\letters\LettersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letters-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'objid') ?>

    <?= $form->field($model, 'appeal1') ?>

    <?= $form->field($model, 'appeal2') ?>

    <?= $form->field($model, 'appeal3') ?>

    <?php // echo $form->field($model, 'firstname') ?>

    <?php // echo $form->field($model, 'secondnameid') ?>

    <?php // echo $form->field($model, 'patronymicnameid') ?>

    <?php // echo $form->field($model, 'signid') ?>

    <?php // echo $form->field($model, 'text1') ?>

    <?php // echo $form->field($model, 'text2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
