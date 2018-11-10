<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\letters\Signature;
use yii\grid\GridView;
use yii\data\SqlDataProvider;
/* @var $this yii\web\View */
/* @var $model app\models\letters\Letters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letters-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="row"> 
		<div class="col-md-6 col-md-offset-6">
			<?= $form->field($model, 'appeal1')->textarea(['rows' => 6]) ?>
		</div>
	</div>
	<div class="row"> 
		<div class="col-md-6 col-md-offset-6">
		    <?= $form->field($model, 'appeal2')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	<div class="row"> 
		<div class="col-md-4 col-md-offset-4">
		    <?= $form->field($model, 'appeal3')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	<div class="row">
		<div class='col-md-12'>
		    <?= $form->field($model, 'text1')->textarea(['rows' => 3]) ?>
		
			<?=$model->site->fulladdress ?>
		
		    <?= $form->field($model, 'text2')->textarea(['rows' => 3]) ?>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-6'>
			<?php
		    // $dataProvider = new ArrayDataProvider([
		        // 'allModels' => $people,
				// 'pagination' => false,
		        // 'key' => 'id',
		        // // 'sort' => [
		            // // 'attributes' => [
						// // 'companyid', 
						// // 'fullname'
					// // ],
		            // // 'defaultOrder' => [
						// // 'man.companyid' => SORT_ASC,
		                // // 'man.fullname' => SORT_ASC,
		            // // ],
		        // // ],
		    // ]);
			
			
			$dataProvider = new SqlDataProvider([
				'sql' => '
					SELECT *, p.id as pid 
					FROM people p
					LEFT OUTER JOIN (SELECT * FROM letters_lists WHERE letterid = :letterid) ll ON p.id = ll.manid
					LEFT OUTER JOIN people_companies pc ON p.companyid = pc.id
					ORDER BY pc.simplename, p.firstname',
				'params' => [':letterid' => $model->id],
				'pagination' => false,
			]);
			
			
			$currentCompanyID = null;
		// 	Yii::warning('language = ' . Yii::app()->language);
			echo GridView::widget([
		        'dataProvider' => $dataProvider,
				'showHeader' => false,
				'caption' => '<h3 style="display:inline">Работники</h3>' . ' ' . 
					Html::a(
					'<span class="glyphicon glyphicon-plus"></span>', 
					['letters/lists/update', 'id' => $model->id], 
					['title' => Yii::t('yii', 'добавить'), 'name' => 'lists']),
				'beforeRow' => function ($model, $key, $index, $grid) use (&$currentCompanyID)
				{
				
				// print_r($model);
				// die();
					if($model['companyid'] != $currentCompanyID) {
		// 				return '<tr><td colspan=10>'.$model->month.'</td></tr>';
						$currentCompanyID = $model['companyid'];
						if(isset($model['simplename'])) $companyName = $model['simplename'];
						else $companyName = null;
						// Yii::warning(print_r($model, true));
						return '<tr><td colspan=3>' . $companyName . '</td></tr>';
					}
				},
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],
		            [
		                'class' => 'yii\grid\CheckboxColumn',
		                'header' => 'выбор',
		                'name' => 'Letters[select]',
						'checkboxOptions' => function ($data) {
							
							// Yii::warning(print_r($data->ll, true));
							// Yii::warning(var_dump($data['ll']));
							// die();
// 							if(isset($data['manid'])) {
// 								$manid = $data['manid'];
// 								// Yii::warning('$manid = '. $manid);
// 							}
// 							else $manid = 0;

 
		                    return [
			                    'value' => $data['pid'],
								'checked' => $data['pid'] == $data['manid'],
		                    ];
		                }
		            ],
		            'firstname',
					'pid',
					'manid',
					[
						'class' => 'yii\grid\ActionColumn',
					],
		        ],
		    ]); ?>
		</div>
	</div>
	<div class="row"> 
		<div class="col-md-4">
			<?= $form->field($model, 'signid')->dropDownList(ArrayHelper::map(Signature::find()->orderBy('id')->all(), 'id', 'chief.fullname'), ['prompt'=>'']) ?>
		</div>
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
