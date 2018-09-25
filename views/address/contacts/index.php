<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = ['label' => $site->sitename, 'url' => ['sites/view', 'id' => $site->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create', 'siteID' => $site->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
//         'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'dataProvider' => new ArrayDataProvider([
            'allModels' => $contacts,
            'key' => 'id',
        ]),
        'columns' => [
            'contact',
            'description',
			//'objID',

            [
				'class' => 'yii\grid\ActionColumn', 
				'contentOptions' =>['style' => 'white-space: nowrap'],
				'template'=>'{update} {delete}',
				'buttons'=>[
					'update' => function ($url, $othermodel) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
								'title' => Yii::t('yii', 'Редактировать'),
						]);                                
					},
					'delete' => function ($url, $othermodel) {
						$options = [
		                    'title' => Yii::t('yii', 'Удалить'),
		                    'aria-label' => Yii::t('yii', 'Удалить'),
		                    'data-confirm' => Yii::t('yii', 'Действительно хотите удалить?'),
		                    'data-method' => 'post',
		                    'data-pjax' => '0',
	                    ];
// 						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
// 								'title' => Yii::t('yii', 'Удалить'),
// 						]);
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options
						);      
					},
				],
				'urlCreator' => function ($action, $othermodel, $key, $index) use ($site) {
					if ($action === 'update') {
						$url ='index.php?r=contacts/update&id=' . $othermodel->id . '&siteID=' . $site->id;
						return $url;
					}

					if ($action === 'delete') {
						$url ='index.php?r=contacts/delete&id=' . $othermodel->id . '&siteID=' . $site->id;
						return $url;
					}
				}
			],
        ],
    ]); 
// print_r($this);
?>
</div>
