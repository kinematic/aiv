<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\letters\Lists */
/* @var $form yii\widgets\ActiveForm */
<<<<<<< Updated upstream
=======
var_dump(\Yii::$app->controller);
die();
echo $tmp;
print_r($people);
>>>>>>> Stashed changes
?>

<div class="lists-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'letterid')->hiddenInput() ?>

    <?= $form->field($model, 'manid')->hiddenInput() ?>

	<div class='row'>
		<div class='col-md-6'>
			<?php
		    $dataProvider = new ArrayDataProvider([
		        'allModels' => $people,
				'pagination' => false,
		        'key' => 'id',
// 		        'sort' => [
// 		            'attributes' => [
// 						'man.companyid', 
// 						'man.fullname'
// 					],
// 		            'defaultOrder' => [
// 						'man.companyid' => SORT_ASC,
// 		                'man.fullname' => SORT_ASC,
// 		            ],
// 		        ],
		    ]);
			$currentCompanyID = null;
// 			Yii::warning('language = ' . Yii::app()->language);
			echo GridView::widget([
		        'dataProvider' => $dataProvider,
				'showHeader' => false,
// 				'caption' => '<h3 style="display:inline">Работники</h3>' . ' ' . 
// 					Html::a(
// 					'<span class="glyphicon glyphicon-plus"></span>', 
// 					['letters/lists/update', 'id' => $model->id], 
// 					['title' => Yii::t('yii', 'добавить'), 'name' => 'lists']),
// 				'beforeRow' => function ($model, $key, $index, $grid) use (&$currentCompanyID)
// 				{
// 					if($model->man->companyid != $currentCompanyID) {
// 						return '<tr><td colspan=10>'.$model->month.'</td></tr>';
// 						$currentCompanyID = $model->man->companyid;
// 						return '<tr><td colspan=3>' . $model->man->company->simplename . '</td></tr>';
// 					}
// 				},
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],

		            'fullname',
					[
						'class' => 'yii\grid\ActionColumn'
					],
		        ],
		    ]); ?>
	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
