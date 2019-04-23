<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\import\Mustang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mustang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'object')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'planedaddress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'realaddress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'juricaladdress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contacts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startdate')->textInput() ?>

    <?= $form->field($model, 'closedate')->textInput() ?>

    <?= $form->field($model, 'mol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inventory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastinventorydate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
