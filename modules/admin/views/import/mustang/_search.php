<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\import\MustangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mustang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'object') ?>

    <?= $form->field($model, 'planedaddress') ?>

    <?= $form->field($model, 'realaddress') ?>

    <?= $form->field($model, 'juricaladdress') ?>

    <?php // echo $form->field($model, 'contacts') ?>

    <?php // echo $form->field($model, 'startdate') ?>

    <?php // echo $form->field($model, 'closedate') ?>

    <?php // echo $form->field($model, 'mol') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'inventory') ?>

    <?php // echo $form->field($model, 'lastinventorydate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
