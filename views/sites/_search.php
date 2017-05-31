<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Sitestype;
use app\models\address\Obl;

/* @var $this yii\web\View */
/* @var $model app\models\SitesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sites-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE,
// 		'layout' => 'horizontal'
    ]); ?>
    <?php if(!$model->sitetype) $model->sitetype = 'RBS' ?>
    <?= $form->field($model, 'sitetype')->dropDownList(ArrayHelper::map(
		Sitestype::find()
			->select(['left(name, 3) AS sn'])
			->asArray()->where(['visible' => 1])
			->groupBy('sn')
			->orderBy(['sn' => SORT_ASC])->all(), 
		'sn', 'sn'), 
		[
			'prompt' => '', 
// 			'options' => ['RBS' => ['selected' => 'selected']],
		]) 
	?>
    <?php if(!$model->oblid2) $model->oblid2 = 4 ?>
    <?= $form->field($model, 'oblid2')->dropDownList(ArrayHelper::map(
		Obl::find()
			->asArray()
			->orderBy(['name' => SORT_ASC])->all(), 
		'id', 'name'), 
		[
			'prompt' => '', 
// 			'options' => ['4' => ['selected' => 'selected']]
		]);
	?>

    <?= $form->field($model, 'nr') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
