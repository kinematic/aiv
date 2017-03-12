<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Sitestype;
use app\models\Sitesregion;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SitesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сайты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sites-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'sitename',
//             [
//                 'attribute' => 'sitename',
//                 'value' => function ($data) {
//                     return Html::a(Html::encode($data->sitename), Url::to(['sites/view', 'id' => $data->id]));
//                 },
//                 'format' => 'raw',
//                 'contentOptions' =>['style' => 'white-space: nowrap'],
//             ],
            [
                'attribute' => 'typeid',
                'value' => 'type',
                'filter' => Html::activeDropDownList(
                    $searchModel, 
                    'typeid', 
                    ArrayHelper::map(Sitestype::find()->asArray()->orderBy(['name' => SORT_ASC])->all(), 
                    'id', 
                    'name'),
                    [
                        'class'=>'form-control',
                        'prompt' => '',
                        'options' => ['12' => ['selected'=>'selected']]
                    ]),
                        
            ],
            [
		'attribute' => 'regionid',
		'value' => 'region',
		'filter' => Html::activeDropDownList(
		    $searchModel, 
		    'regionid', 
		    ArrayHelper::map(Sitesregion::find()->asArray()->orderBy(['name' => SORT_ASC])->all(), 
		    'id', 
		    'name'),
		    ['class'=>'form-control','prompt' => '']),
            ],
            //'typeid',
            //'regionid',
            'nr',
            //'objid',
            // 'relationid',
            //'description:ntext',
	    //'obl',
            // 'statusid',
            // 'opendate',
            // 'closedate',
            // 'molid',
            // 'inventdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
//     print_r($this);
    ?>
</div>
