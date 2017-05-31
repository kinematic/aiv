<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Sites */

$this->title = $model->sitename;
$this->params['breadcrumbs'][] = ['label' => 'Сайты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sites-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',https://www.google.com.ua/maps?q=+50.345,+30.428333&hl=ru
//             'fullgps',
            [
                'attribute' => 'fullgps',
                'value' => function ($data) {
					if (isset($data->gps->lat))
						return $data->fullgps . ' ' .
						Html::a(Html::img('images/googleMaps.png', ['alt' => 'картинка', 'height' => '20', 'width' => '20']), 
						Url::to('https://maps.google.com/maps?q=+' . $data->gps->lat / 1000000 . ',+' . $data->gps->long / 1000000 . '&hl=uk', true),
						['target' => '_blank']);
                    else return null;
                },
                'format' => 'raw',
                'contentOptions' =>['style' => 'white-space: nowrap'],
            ],
            'fulladdress',
 
            //'relationid',
            //'description:ntext',
            'comment.value:ntext',
            'status',
            'mol.molname',
            'opendate',
            'closedate',
            'inventdate',
        ],
    ]);
    
//         $dataProvider = new ArrayDataProvider([
//             'allModels' => $model->relations,
//             'key' => 'id',
//         ]);
?>

<?php
        echo GridView::widget([
            'dataProvider' => new ArrayDataProvider([
	            'allModels' => $model->relations,
	            'key' => 'id',
	        ]),
	        'caption' => Html::a('<h3>связанные сайты</h3>', ['relations', 'id' => $model->id, 'searchmode' => 1], ['title' => 'Редактировать']),
	        'showOnEmpty' => false,
	        'emptyText' => '<p>Сайт не связан с сооружением, ' . Html::a('создать?', ['create-object', 'id' => $model->id]) . '</p>',
	        'layout' => "{items}",
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

        echo GridView::widget([
            'dataProvider' => new ArrayDataProvider([
	            'allModels' => $model->contacts,
	            
	            'key' => 'id',
	        ]),
	        'caption' => Html::a('<h3>контакты</h3>', ['/contacts', 'siteID' => $model->id], ['title' => 'Редактировать']),
	        'showHeader' => false,
	        'showOnEmpty' => false,
	        'emptyText' => '',
	        'layout' => "{items}",
            'columns' => [
	            [
	                'attribute' => 'contact',
	                'contentOptions' =>['style' => 'white-space: nowrap'],
	            ],
	            'description',
            ]

        ]); 
        
        echo GridView::widget([
            'dataProvider' => new ArrayDataProvider([
	            'allModels' => $model->discrepancy,
	            
	            'key' => 'id',
	        ]),
// 	        'caption' => Html::a('<h3>расхождения инвентаризации</h3>', ['inventory/discrepancy', 'DiscrepancySearch[siteid]' => $model->id], 
// 								['title' => 'Редактировать', 'name' => 'discrepancy']),
			'caption' => '<h3 style="display:inline">расхождения инвентаризации</h3>' . ' ' . Html::a('<span class="glyphicon glyphicon-plus"></span>', ['inventory/discrepancy/create', 'Discrepancy[siteid]' => $model->id], ['title' => Yii::t('yii', 'добавить')]),
	        'showHeader' => false,
	        'showOnEmpty' => true,
	        'emptyText' => '',
	        'layout' => "{items}",
            'columns' => [
				[
	                'attribute' => 'sites.sitename',
	                'value' => function ($data) {
	                    return Html::a(Html::encode($data->sites->sitename), Url::to(['view', 'id' => $data->siteid]));
	                },
	                'format' => 'raw',
	                'contentOptions' =>['style' => 'white-space: nowrap'],
	            ],
				'discrepancy',
	            [
	                'attribute' => 'catalog.codename',
	                'contentOptions' =>['style' => 'white-space: nowrap'],
	            ],
	            'partcount',
	            'description',
				[
					'class' => 'yii\grid\ActionColumn',
					'urlCreator'=>function($action, $model, $key, $index){
						return ['inventory/discrepancy/' . $action,'id'=>$model->id, 'siteid'=>$model->siteid];
					},
					'contentOptions' =>['style' => 'white-space: nowrap'],
				],
				
            ]

        ]);
        
//         print $model->searchNr . '<br>' . $model->searchOtherNr;
//     var_dump($model);
//     print_r($this);
//     print 'https://maps.google.com/maps?q=+' . $model->gps->lat / 1000000 . ',+' . $model->gps->long / 1000000 . '&hl=uk';

    ?>
	<p>
        <?= Html::a('Письма на проход', ['letters/letters/viewbyobjid', 'objid' => $model->objid], ['class' => 'btn btn-primary']) ?>
        
    </p>
  </div>
