<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\sites\SitesSearch;

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
	
	<?= $this->render('_searchrelation', ['model' => $model]);?>
	
	
	<?php	
        echo GridView::widget([
            'dataProvider' => new ArrayDataProvider([
				'allModels' => $model->relations,
				'key' => 'id',
			]),
			'caption' => '<h3>существующие связи</h3>',
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
				['class' => 'yii\grid\ActionColumn',
					'template'=>'{deleteJoin}',
					'buttons'=>[
						'deleteJoin' => function ($url, $othermodel) {
							return Html::a('<span class="glyphicon glyphicon-minus iconJoinDelete"></span>', $url, [
									'title' => Yii::t('yii', 'удалить связь'),
							]);                                
						},
					],
					'urlCreator' => function ($action, $othermodel, $key, $index) use ($model) {
						
						if ($action === 'deleteJoin') {
							$url ='index.php?r=sites/delete-object&id=' . $model->id . '&deleteID=' . $othermodel->id . '&searchByNumber=' . $model->searchByNumber;
							return $url;
						}
					}                           
				]
            ]

        ]); 
    ?>

	<?php } else {?>
	<p>Сайт не связан с сооружением, <?= Html::a('создать?', ['create-object', 'id' => $model->id])?></p>
	
	<?php }?>

	
	
	
	
	
	<?php 
	$searchModel = new SitesSearch();
	$dataProvider = $searchModel->search(['SitesSearch' => 
								[
									'relation' => 'withObject',
									'siteid' => $model->id,
									'objid' => $model->objid,
									'nr' => $model->searchByNumber, 
									'oblid2' => $model->sitesregion->oblid,
								]
							]);
    if(!$model->objid) $actionColumn = 
		['class' => 'yii\grid\ActionColumn',
			'template'=>'{joinOne} {joinOther}',
			'buttons'=>[
				'joinOne' => function ($url, $othermodel) {
					return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
							'title' => Yii::t('yii', 'на площадке RBS'),
					]);                                
				},
				'joinOther' => function ($url, $othermodel) {
					return Html::a('<span class="glyphicon glyphicon-plus iconJoinOther"></span>', $url, [
							'title' => Yii::t('yii', 'на отдельной площадке'),
					]);                                
				}
			],
			'urlCreator' => function ($action, $othermodel, $key, $index) use ($model) {
				
				if ($action === 'joinOne') {
					$url ='index.php?r=sites/join-object&id=' . $model->id . '&objID=' . $othermodel->objid . '&siteID=' . $model->id . '&relationID=2' . '&searchByNumber=' . $model->searchByNumber;
					return $url;
				}
				if ($action === 'joinOther') {
					$url ='index.php?r=sites/join-object&id=' . $model->id . '&objID=' . $othermodel->objid . '&siteID=' . $model->id . '&relationID=3' . '&searchByNumber=' . $model->searchByNumber;
					return $url;
				}

			}                           
		];
	else $actionColumn = [];
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'caption' => '<h3>предполагаемые сайты с сооружением</h3>',
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


	
	
	<?php 

	$searchModel = new SitesSearch();
	$dataProvider = $searchModel->search(['SitesSearch' => 
									[
										'relation' => 'nonObject',
										'siteid' => $model->id,
										'nr' => $model->searchByNumber, 
										'oblid2' => $model->sitesregion->oblid,
									]
								]);
    if($model->objid) $actionColumn = 
		['class' => 'yii\grid\ActionColumn',
			'template'=>'{joinOne} {joinOther}',
			'buttons'=>[
				'joinOne' => function ($url, $othermodel) {
					return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
							'title' => Yii::t('yii', 'на площадке RBS'),
					]);                                
				},
				'joinOther' => function ($url, $othermodel) {
					return Html::a('<span class="glyphicon glyphicon-plus iconJoinOther"></span>', $url, [
							'title' => Yii::t('yii', 'на отдельной площадке'),
					]);                                
				}                            
			],
			'urlCreator' => function ($action, $othermodel, $key, $index) use ($model) {
				
				if ($action === 'joinOne') {
					$url ='index.php?r=sites/join-object&id=' . $model->id . '&objID=' . $model->objid . '&siteID=' . $key . '&relationID=2' . '&searchByNumber=' . $model->searchByNumber;
					return $url;
				}
				if ($action === 'joinOther') {
					$url ='index.php?r=sites/join-object&id=' . $model->id . '&objID=' . $model->objid . '&siteID=' . $key . '&relationID=3' . '&searchByNumber=' . $model->searchByNumber;
					return $url;
				}
			}                           
		];
  	else $actionColumn = [];
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'caption' => '<h3>предполагаемые сайты без сооружения</h3>',
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
// print_r($model->sitesregion) ;
// print $model->searchmode;
	?>
	<?php //if($model->searchmode <> 2) echo Html::a('Найти другой сайт', ['relations', 'id' => $model->id, 'searchmode' => 2], ['class' => 'btn btn-success']) ?>
	
</div>
