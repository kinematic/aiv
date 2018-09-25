<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\inventory\SitesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sites-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'typeid') ?>

    <?= $form->field($model, 'regionid') ?>

    <?= $form->field($model, 'nr') ?>

    <?= $form->field($model, 'objid') ?>

    <?php // echo $form->field($model, 'relationid') ?>

    <?php // echo $form->field($model, 'mustangaddress') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'statusid') ?>

    <?php // echo $form->field($model, 'opendate') ?>

    <?php // echo $form->field($model, 'closedate') ?>

    <?php // echo $form->field($model, 'molid') ?>

    <?php // echo $form->field($model, 'inventdate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
