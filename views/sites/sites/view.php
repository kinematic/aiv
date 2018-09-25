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

	<div class='container'>
		<ul class='nav nav-tabs'>
			<li class='active'><a href='#main' data-toggle='tab'>общее</a></li>
			<li><a href='#visits' data-toggle='tab'>посещения</a></li>
			<li><a href='#discrepancy' data-toggle='tab'>расхождения</a></li>
			<li><a href='#letters' data-toggle='tab'>письма</a></li>
		</ul>
	</div>
	<div class='tab-content'>
		<div class='tab-pane active' id='main'>
		    <p>
				<?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
			</p>
		
			 <?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				[
					'attribute' => 'fullgps',
					'value' => function ($data) {
						if (isset($data->gps->lat))
							return $data->fullgps . ' ' .
							Html::a(Html::img('images/googleMaps.png', ['alt' => 'карта', 'height' => '20', 'width' => '20']), 
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
		?>
        <?= GridView::widget([
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
        ?>

		
		</div>
				<div class='tab-pane' id='visits'>
				<p>
				<?php
				if (isset($model->code->code)) print '<p>код снятия с охраны: ' . $model->code->code;
				?>
				<?php

				echo GridView::widget([
					'dataProvider' => new ArrayDataProvider([
						'allModels' => $model->visits,
						'key' => 'id',
					]),
					// 'caption' => Html::a('<h3>посещения</h3>', ['relations', 'id' => $model->id, 'searchmode' => 1], ['title' => 'Редактировать']),
					'showOnEmpty' => false,
					// 'emptyText' => '<p>Сайт не связан с сооружением, ' . Html::a('создать?', ['create-object', 'id' => $model->id]) . '</p>',
					'layout' => "{items}",
					'columns' => [

						'mo',
						'username',
						[
							'attribute' => 'phone',
							'value' => function ($data) {
								return '0' . $data->phone;
							},
						],
						[
							'attribute' => 'firstoc',
							'value' => function ($data) {
								return date('Y-m-d H:i', $data->firstoc);
							},
						],
												[
							'attribute' => 'cleartime',
							'value' => function ($data) {
								return date('Y-m-d H:i', $data->cleartime);
							},
						],
					]

				]); 
				?>
		</div>
		<div class='tab-pane' id='discrepancy'>
		<?php

		$title = 'title';
		
        echo GridView::widget([
            'dataProvider' => new ArrayDataProvider([
	            'allModels' => $model->discrepancy,
	            
	            'key' => 'id',
	        ]),
// 	        'caption' => Html::a('<h3>расхождения инвентаризации</h3>', ['inventory/discrepancy', 'DiscrepancySearch[siteid]' => $model->id], 
// 								['title' => 'Редактировать', 'name' => 'discrepancy']),
			'caption' => '<h3 style="display:inline">расхождения инвентаризации</h3>' . ' ' . Html::a('<span class="glyphicon glyphicon-plus"></span>', ['inventory/discrepancy/create', 'Discrepancy[siteid]' => $model->id], ['title' => Yii::t('yii', 'добавить'), 'name' => 'discrepancy']),
	        'showHeader' => false,
	        'showOnEmpty' => true,
	        'emptyText' => '',
	        'layout' => "{items}",
			// 'rowOptions'=>function ($model, $key, $index, $grid){
				// $class=$index%2?'odd':'even';
				// return [
					// 'key'=>$key,
					// 'index'=>$index,
					// 'class'=>$class
					
				// ];
			// }
            'columns' => [
				// [
	                // 'attribute' => 'sites.sitename',
	                // 'value' => function ($data) {
	                    // return Html::a(Html::encode($data->sites->sitename), Url::to(['view', 'id' => $data->siteid]));
	                // },
	                // 'format' => 'raw',
	                // 'contentOptions' =>['style' => 'white-space: nowrap'],
	            // ],
				[
	                'attribute' => 'sites.sitename',
	                'contentOptions' =>['style' => 'white-space: nowrap'],
	            ],
				'discrepancy',
	            [
	                'attribute' => 'catalog.codename',
					'value' => function ($data) {
						// Yii::warning(print_r($data, true));
	                    return "<span title='" . $data->catalog->description . "'>" . $data->catalog->codename . '</span>';
	                },
					'format' => 'raw',
	                'contentOptions' => [
						'style' => 'white-space: nowrap',
						// 'title' => $title,
						// 'title' => 'catalog.description',
						// 'title' => var_dump($model->discrepancy),
						// 'title' => print_r($model->discrepancy, true),
						// 'title' => yii::warning(print_r($model->discrepancy, true)),
						// 'title' => function ($data) {
						// yii::warning(print_r($data, true));
	                    // return 'код';
						
						// 'title' => function ($model, $key, $index, $grid) {
							// return 'kod';
						// },
					],
	            ],
	            'partcount',
	            'description',
				'swnumbers',
				'hwnumbers',
				[
					'class' => 'yii\grid\ActionColumn',
					'urlCreator'=>function($action, $model, $key, $index){
						return ['inventory/discrepancy/' . $action,'id'=>$model->id, 'siteid'=>$model->siteid];
					},
					'contentOptions' =>['style' => 'white-space: nowrap'],
				],
				
            ]

        ]);
    ?>
		
		</div>

				<div class='tab-pane' id='letters'>
				<p>
			<?= Html::a('Письма на проход', ['letters/letters/viewbyobjid', 'objid' => $model->objid], ['class' => 'btn btn-primary']) ?>
			
		</p>
		</div>
		
	<div>
	


   



  </div>
