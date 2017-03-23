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
            'molname',
            'opendate',
            'closedate',
            'inventdate',
        ],
    ]);
    
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model->objects,
            'key' => 'id',
			'sort' => [
				'defaultOrder' => [
                    'nr' => SORT_ASC,
                    //'second_name' => SORT_ASC,
                ],
				'attributes' => [
					'nr' => [
                        'asc' => ['nr' => SORT_ASC, 'nr' => SORT_ASC],
                        'desc' => ['nr' => SORT_DESC, 'nr' => SORT_DESC],
                   ],
				],
			],
            'pagination' => [
                 'pageSize' => 30,
            ],
        ]);
?>

<?php
        echo Html::a('<h3>Связанные объекты</h3>', ['relations', 'id' => $model->id], ['title' => 'Редактировать']);
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
//         print $model->searchNr . '<br>' . $model->searchOtherNr;
//     var_dump($model);
//     print_r($this);
//     print 'https://maps.google.com/maps?q=+' . $model->gps->lat / 1000000 . ',+' . $model->gps->long / 1000000 . '&hl=uk';

    ?>
  </div>
