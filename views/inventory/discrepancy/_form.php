<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Sites;
use app\models\inventory\Catalog;
// use yii2mod\selectize\Selectize;

/* @var $this yii\web\View */
/* @var $model app\models\inventory\Discrepancy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discrepancy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
//    $data = ArrayHelper::map(Sites::find()->addOrderBy('nr')->all(), 'id', 'nr');
//    echo $form->field($model, 'siteid')->widget(Selectize::className(), [
//            'items' => $data,
//            'pluginOptions' => [
//                'persist' => false,
//                'createOnBlur' => false,
//                'create' => true,
//               'allowEmptyOption' => true,
//            ]
//    ]);  
	?>
	
	<?= $form->field($model, 'siteid')->hiddenInput()->label(false); ?>

	<?= $form->field($model, 'catalogid')->dropDownList(ArrayHelper::map(Catalog::find()->orderBy('codename')->all(), 'id', 'codename'), ['prompt'=>''])
	->label('код товара ' . Html::a('<span class="glyphicon glyphicon-plus"></span>', ['inventory/catalog/create', 'Discrepancy[id]' => $model->id], ['title' => Yii::t('yii', 'добавить')])); ?>

	<?php if(!$model->partcount) $model->partcount = 1?>
	
	<?= $form->field($model, 'partcount')->textInput() ?>
	
	<?php if(!$model->discrepancyid) $model->discrepancyid = 1?>
	
	<?= $form->field($model, 'serialnumbers')->textInput() ?>

	<?= $form->field($model, 'discrepancyid')->dropDownList(array (1 => 'недостача', 2 => 'излишек'), ['prompt'=>'']) ?>
	
	<?= $form->field($model, 'description')->textarea(['rows' => '6']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
