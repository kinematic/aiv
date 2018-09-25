<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\sites\SitesforupdateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sitesforupdate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'planedaddress') ?>

    <?= $form->field($model, 'realaddress') ?>

    <?= $form->field($model, 'juricaladdress') ?>

    <?php // echo $form->field($model, 'startdate') ?>

    <?php // echo $form->field($model, 'closedate') ?>

    <?php // echo $form->field($model, 'mol') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'isinventory') ?>

    <?php // echo $form->field($model, 'lastinventorydate') ?>

    <?php // echo $form->field($model, 'typeid') ?>

    <?php // echo $form->field($model, 'regionid') ?>

    <?php // echo $form->field($model, 'nr') ?>

    <?php // echo $form->field($model, 'siteid') ?>

    <?php // echo $form->field($model, 'statusid') ?>

    <?php // echo $form->field($model, 'molid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
