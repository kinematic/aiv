<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\letters\Signature;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
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
    <?= $form->field($model, 'text1')->textarea(['rows' => 3]) ?>
	<div class="row">
		<?=$model->site->fulladdress ?>
	</div>
    <?= $form->field($model, 'text2')->textarea(['rows' => 3]) ?>
	<div class='row'>
		<div class='col-md-6'>
			<?php
		    $dataProvider = new ArrayDataProvider([
		        'allModels' => $people,
				'pagination' => false,
		        'key' => 'id',
		        // 'sort' => [
		            // 'attributes' => [
						// 'companyid', 
						// 'fullname'
					// ],
		            // 'defaultOrder' => [
						// 'man.companyid' => SORT_ASC,
		                // 'man.fullname' => SORT_ASC,
		            // ],
		        // ],
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
					if($model->companyid != $currentCompanyID) {
		// 				return '<tr><td colspan=10>'.$model->month.'</td></tr>';
						$currentCompanyID = $model->companyid;
						if(isset($model->company->simplename)) $companyName = $model->company->simplename;
						else $companyName = null;
						// Yii::warning(print_r($model, true));
						return '<tr><td colspan=3>' . $companyName . '</td></tr>';
					}
				},
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],

		            'fullname',
					[
						'class' => 'yii\grid\ActionColumn',
						'header' => 'Actions',
						'headerOptions' => ['style' => 'color:#337ab7'],
						'template' => '{view} {update} {delete}',
						'buttons' => [
						'view' => function ($url, $model) {
							return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => Yii::t('app', 'lead-view')]);
						},

						'update' => function ($url, $model) {
							return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('app', 'lead-update')]);
						},
						'delete' => function ($url, $model) {
							return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title' => Yii::t('app', 'lead-delete')]);
						}
						],
						'urlCreator' => function ($action, $model, $key, $index) {
							if ($action === 'view') {
							$url ='index.php?r=client-login/lead-view&id='.$model->id;
							return $url;
						}

						if ($action === 'update') {
							$url ='index.php?r=client-login/lead-update&id='.$model->id;
							return $url;
						}
						if ($action === 'delete') {
							$url ='index.php?r=client-login/lead-delete&id='.$model->id;
							return $url;
						}

						}
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
