<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\import\SitesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'сайты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sites-index">
	<?php 
	echo Nav::widget([
		'items' => [
			[
				'label' => 'импортировать',
				'url' => ['import/sites/load'],
				// 'linkOptions' => [...],
			],
			[
				'label' => 'показать',
				'items' => [
					 ['label' => 'новые сайты', 'url' => 'index.php?r=import/sites/new'],
					 ['label' => 'нераспознанные сайты', 'url' => 'index.php?r=import/sites/notdefs'],
					 // ['label' => 'обновления', 'url' => '#'],
					 ['label' => 'сайты, которых нет в Мустанге', 'url' => 'index.php?r=import/sites/nonexists'],
					 ['label' => 'нет МОЛа', 'url' => '#'],
					 ['label' => 'дубликаты', 'url' => '#'],
					 ['label' => 'сайты без объекта', 'url' => '#'],
					 '<div class="dropdown-divider"></div>',
					 '<div class="dropdown-header">Dropdown Header</div>',
					 ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
				],
			],
			[
				'label' => 'применить',
				'url' => ['site/login'],
				// 'visible' => Yii::$app->user->isGuest
			],
		],
		'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
	]);
	?>
	<?php 
	if($this->context->action->id == 'new') $this->title = 'Новые сайты';
	if($this->context->action->id == 'notdefs') $this->title = 'Нераспознанные сайты';
	
	?>



    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'object',
            'planedaddress:ntext',
            //'realaddress:ntext',
            //'mol',
            'status',
            //'inventory',
            //'lastinventorydate',
            //'juricaladdress:ntext',
            //'contacts',
            //'startdate',
            //'closedate',
            //'contractor',
            'typeid',
            'regionid',
            'nr',
            //'siteid',
            //'statusid',
            //'molid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
