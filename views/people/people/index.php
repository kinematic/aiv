<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\people\Companies;

/* @var $this yii\web\View */
/* @var $searchModel app\models\people\PeopleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Люди';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="people-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			'fullname',
			[
				'attribute' => 'company.simplename',                 
				'value' => 'company.simplename',
				'filter' => Html::activeDropDownList(
					$searchModel,
					'companyID',
					ArrayHelper::map(Companies::find()->select(['id', 'simplename'])->asArray()->orderBy('simplename')->all(),
					'id',
					'simplename'
					),
					[
						'class' => 'form-control',
						'prompt' => '',
					]
				)
			],
            // 'sname.name',
            // 'pname.name',
			// 'company.simplename',
            // 'positionid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
