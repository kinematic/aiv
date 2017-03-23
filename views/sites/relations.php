<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\SitesSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Sites */

$this->title = $model->sitename;
$this->params['breadcrumbs'][] = ['label' => 'Сайты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sitename, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Связи';
?>
<div class="sites-relations">

    <h1><?= Html::encode($this->title) ?></h1>

	<p><b>адрес: </b><?= $model->fulladdress ?></p>

	<?php if(isset($model->objid)) {?>

	<p>Сайт связан с сооружением, <?= Html::a('удалить?', ['delete-object', 'id' => $model->id])?></p>
	
	<h3>Существующие связи</h3>
	<?php	
	    $dataProvider = new ArrayDataProvider([
            'allModels' => $model->objects,
            'key' => 'id',
        ]);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
				[
					'attribute' => 'nr',
					'value' => function ($data) {
						return Html::a(Html::encode($data->sitename), Url::to(['view', 'id' => $data->id]));
					},
					'format' => 'raw',
					'contentOptions' =>['style' => 'white-space: nowrap'],
				],
				'status',
				'rel',
				
            ]

        ]); 
    ?>

	<?php } else {?>
	<p>Сайт не связан с сооружением, <?= Html::a('создать?', ['create-object', 'id' => $model->id])?></p>
	
	<?php }?>

	
	
	
	<h3>Предполагаемые сайты с сооружением</h3>
	
	<?php 
	$searchModel = new SitesSearch();
	$dataProvider = $searchModel->search(['SitesSearch' => 
								[
									'relation' => 'withObject',
									'siteid' => $model->id,
									'objid' => $model->objid,
									'nr' => $model->nr, 
									'oblid' => $model->sitesregion->oblid,
								]
							]);
    if(!$model->objid) $actionColumn = 
		['class' => 'yii\grid\ActionColumn',
			'template'=>'{joinOne} {joinOther}',
			'buttons'=>[
				'joinOne' => function ($url, $othermodel) {
					return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
							'title' => Yii::t('yii', 'присоединить в тоже место'),
					]);                                
				},
				'joinOther' => function ($url, $othermodel) {
					return Html::a('<span class="glyphicon glyphicon-plus iconJoinOther"></span>', $url, [
							'title' => Yii::t('yii', 'присоединить в другое место'),
					]);                                
				}
			],
			'urlCreator' => function ($action, $othermodel, $key, $index) use ($model) {
				
				if ($action === 'joinOne') {
					$url ='index.php?r=sites/join-object&objid=' . $othermodel->objid . '&siteid=' . $model->id;
					return $url;
				}
				if ($action === 'joinOther') {
					$url ='index.php?r=sites/join-object&objid=' . $othermodel->objid . '&siteid=' . $model->id;
					return $url;
				}

			}                           
		];
	else $actionColumn = [];
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
			[
				'attribute' => 'nr',
				'value' => function ($data) {
					return Html::a(Html::encode($data->sitename), Url::to(['view', 'id' => $data->id]));
				},
				'format' => 'raw',
				'contentOptions' =>['style' => 'white-space: nowrap'],
			],
			'fulladdress',
//             'rel',
			$actionColumn,
        ]

    ]); 
// 	print_r($model->sitesregion->oblid);
	?>


	<h3>Предполагаемые сайты без сооружения</h3>
	
	<?php 

	$searchModel = new SitesSearch();
	$dataProvider = $searchModel->search(['SitesSearch' => 
									[
										'relation' => 'nonObject',
										'siteid' => $model->id,
										'nr' => $model->nr, 
										'oblid' => $model->sitesregion->oblid,
									]
								]);
    if($model->objid) $actionColumn = 
		['class' => 'yii\grid\ActionColumn',
			'template'=>'{join}',
			'buttons'=>[
				'join' => function ($url, $othermodel) {
					return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
							'title' => Yii::t('yii', 'присоединиться'),
					]);                                
				}
			],
			'urlCreator' => function ($action, $othermodel, $key, $index) use ($model) {
				
				if ($action === 'join') {
					$url ='index.php?r=sites/join-object&objid=' . $model->objid . '&siteid=' . $key;
					return $url;
				}

			}                           
		];
  	else $actionColumn = [];
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
            [
                'attribute' => 'nr',
                'value' => function ($data) {
                    return Html::a(Html::encode($data->sitename), Url::to(['view', 'id' => $data->id]));
                },
                'format' => 'raw',
                'contentOptions' =>['style' => 'white-space: nowrap'],
            ],
			'mustangaddress',
			$actionColumn,
            ]
        ]); 

	?>
	
</div>
