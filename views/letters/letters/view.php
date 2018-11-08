<?php

use yii\helpers\Html;
// use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\letters\Letters */

$this->title = 'Письмо на проход на ' . $model->site->sitename;
// $this->params['breadcrumbs'][] = ['label' => 'Letters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->site->sitename, 'url' => ['sites/sites/view', 'id' => $model->site->id]];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
	<div class='row'>
		<div class='col-md-6 col-md-offset-6'>
		    <?= nl2br($model->appeal1) ?><br>
			<?= $model->appeal2 ?>
		</div>
	    
	</div>
    <h3><center><?= $model->appeal3 ?></center></h3>
    <p style="text-indent: 1.5em"><?= $model->text1 . $model->site->fulladdress . $model->text2?></p>
	<div class='row'>
		<div class='col-md-5'>
			<?php
		    $dataProvider = new ArrayDataProvider([
		        'allModels' => $model->list,
		        'key' => 'id',
		        'sort' => [
		            'attributes' => [
						'man.companyid', 
						'man.fullname'
					],
		            'defaultOrder' => [
						'man.companyid' => SORT_ASC,
		                'man.fullname' => SORT_ASC,
		            ],
		        ],
		    ]);
			$currentCompanyID = null;
		// 	Yii::warning('language = ' . Yii::app()->language);
			echo GridView::widget([
		        'dataProvider' => $dataProvider,
				'showHeader' => false,
				'beforeRow' => function ($model, $key, $index, $grid) use (&$currentCompanyID)
				{
					if($model->man->companyid != $currentCompanyID) {
		// 				return '<tr><td colspan=10>'.$model->month.'</td></tr>';
						$currentCompanyID = $model->man->companyid;
						return '<tr><td colspan=3>' . $model->man->company->simplename . '</td></tr>';
					}
				},
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],

		            'man.fullname',

		//             ['class' => 'yii\grid\ActionColumn'],
		        ],
		    ]); ?>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-4 col-md-offset-1'>
			<?php 
				if(isset($model->signature->position)) echo nl2br($model->signature->position); 
				else echo '<mark>немає посади</mark>';	
			?>
		</div>
		<div class='col-md-3 col-md-offset-3'>
			<?php 
				if(isset($model->signature->chief->signature)) echo nl2br($model->signature->chief->signature); 
				else echo '<mark>немає підпису</mark>';	
			?>
		</div>
	</div>

</div>
