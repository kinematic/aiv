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
			$dataProvider = new SqlDataProvider([
				'sql' => "
					SELECT p.id, CONCAT_WS(' ', p.firstname, sn.name, pn.name) AS fullname, ll.manid, pc.simplename AS companyname, pc.id AS companyid
					FROM people p
					LEFT OUTER JOIN people_secondname sn ON p.secondnameid = sn.id
					LEFT OUTER JOIN people_patronymicname pn ON p.patronymicnameid = pn.id
					LEFT OUTER JOIN (SELECT * FROM letters_lists WHERE letterid = :letterid) ll ON p.id = ll.manid
					LEFT OUTER JOIN people_companies pc ON p.companyid = pc.id
					ORDER BY companyname, fullname",
				'params' => [':letterid' => $model->id],
				'pagination' => false,
			]);
			
			$currentCompanyID = null;
			echo GridView::widget([
		        'dataProvider' => $dataProvider,
				'showHeader' => false,
				'caption' => '<h3 style="display:inline">Работники</h3>' . ' ' . 
					Html::a(
					'<span class="glyphicon glyphicon-plus"></span>', 
					['people/people/create'], 
					[
						'title' => Yii::t('yii', 'добавить'), 
						'name' => 'lists',
						'target' => '_blank',
					]),
				'beforeRow' => function ($model, $key, $index, $grid) use (&$currentCompanyID)
				{
					if($model['companyid'] != $currentCompanyID) {
						$currentCompanyID = $model['companyid'];
						if(isset($model['companyname'])) $companyName = $model['companyname'];
						else $companyName = null;
						return '<tr><td colspan="100%"><b>' . $companyName . '</b></td></tr>';
					}
				},
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],
		            [
		                'class' => 'yii\grid\CheckboxColumn',
		                'header' => 'выбор',
		                'name' => 'Letters[peopleSelect]',
						'checkboxOptions' => function ($data) {
							if(isset($data['manid'])) {
								$manid = $data['manid'];
							}
							else $manid = 0;
		                    return [
			                    'value' => $data['id'],
								'checked' => $data['id'] == $manid,
		                    ];
		                }
		            ],
		            'fullname',
					[
						'class' => 'yii\grid\ActionColumn',
						'header' => 'Actions',
						'headerOptions' => ['style' => 'color:#337ab7'],
						'template' => '{view} {update} {delete}',
						'buttons' => [
						'view' => function ($url, $model) {
							return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
								'title' => Yii::t('app', 'lead-view'),
								'target' => '_blank',
							]);
						},

						'update' => function ($url, $model) {
							return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
								'title' => Yii::t('app', 'lead-update'),
								'target' => '_blank',
							]);
						},
						'delete' => function ($url, $model) {
							return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
								'title' => Yii::t('app', 'lead-delete'),
								'target' => '_blank',
							]);
						}

						],
						'urlCreator' => function ($action, $model, $key, $index) {
							if ($action === 'view') {
								$url ='index.php?r=people/people/view&id=' . $model['id'];
								return $url;
							}

							if ($action === 'update') {
								$url ='index.php?r=people/people/update&id=' . $model['id'];
								return $url;
							}
							if ($action === 'delete') {
								$url ='index.php?r=people/people/delete&id=' . $model['id'];
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
