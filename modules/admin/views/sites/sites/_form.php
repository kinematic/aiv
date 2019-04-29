<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\sites\Sitestype;
use app\models\sites\Sitesregion;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\sites\Sites */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sites-form">

    <?php $form = ActiveForm::begin(); ?>

		<div class="row">
		
			<div class="col-md-3">

				<?= $form->field($model, 'typeid')->dropDownList(ArrayHelper::map(Sitestype::find()->orderBy('name')->all(), 'id', 'name')) ?>
	
			</div>
			<div class="col-md-3">
			
				<?= $form->field($model, 'regionid')->dropDownList(ArrayHelper::map(Sitesregion::find()->where('visible IS NOT NULL')->orderBy('name')->all(), 'id', 'name')) ?>
			
			</div>
			<div class="col-md-3">
			
    <?= $form->field($model, 'nr')->textInput(['maxlength' => true]) ?>

			</div>
		</div>
		
    <?= $form->field($model, 'objid')->textInput() ?>

    <?= $form->field($model, 'relationid')->textInput() ?>

    <?= $form->field($model, 'mustangaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'statusid')->textInput() ?>

    <?= $form->field($model, 'opendate')->textInput() ?>

    <?= $form->field($model, 'closedate')->textInput() ?>

    <?= $form->field($model, 'molid')->textInput() ?>

    <?= $form->field($model, 'inventdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
