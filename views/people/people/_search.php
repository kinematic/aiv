<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\people\PeopleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="people-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'secondnameid') ?>

    <?= $form->field($model, 'patronymicnameid') ?>

    <?= $form->field($model, 'companyid') ?>

    <?php // echo $form->field($model, 'positionid') ?>

    <?php // echo $form->field($model, 'passportid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
