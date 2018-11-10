<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii2mod\selectize\Selectize;
use yii\jui\AutoComplete;
use app\models\people\Secondname;
use app\models\people\Patronymicname;

/* @var $this yii\web\View */
/* @var $model app\models\people\People */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="people-form">

    <?php $form = ActiveForm::begin(); ?>

	<div class="row">
		<div class="col-md-4">
		<?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'companyid')->textInput() ?>
		</div>
		<div class="col-md-4">
		<?php 
		$listdata=Secondname::find()->select(['name as value', 'name as label'])->asArray()->all();
		?>
		<?= $form->field($model, 'secondname')->widget(
		AutoComplete::className(), [            
				'clientOptions' => [
					'source' => $listdata,
				],
				'options'=>[
					'class'=>'form-control'
				]
			]);
		?>
		// <?php 
		// if (isset($model->obl->id)) $model->oblid = $model->obl->id;
		// else $model->oblid = '';
		// $data = ArrayHelper::map(Obl::find()->addOrderBy('name')->all(), 'id', 'name');
		// $data = array('' => '') + $data;
		
		// echo $form->field($model, 'oblid')->widget(Selectize::className(), [
				// 'items' => $data,
				// 'pluginOptions' => [
					// 'persist' => false,
					// 'createOnBlur' => false,
					// 'create' => true,
					// 'allowEmptyOption' => true,
				// ]
		// ]); ?>
		<?= $form->field($model, 'positionid')->textInput() ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'patronymicnameid')->textInput() ?>
		</div>
	</div>
		

		

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
