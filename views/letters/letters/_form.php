<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\letters\Signature;
/* @var $this yii\web\View */
/* @var $model app\models\letters\Letters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letters-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'appeal1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'appeal2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'appeal3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text2')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'signid')->dropDownList(ArrayHelper::map(Signature::find()->orderBy('id')->all(), 'id', 'user.fullname'), ['prompt'=>'']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
