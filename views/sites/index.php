<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\helpers\ArrayHelper;
use yii\grid\GridView;
// use app\models\Sitestype;
// use app\models\Sitesregion;
// use app\models\address\Obl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SitesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сайты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sites-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'nr',
                'value' => function ($data) {
                    return Html::a(Html::encode($data->sitename), Url::to(['view', 'id' => $data->id]));
                },
                'format' => 'raw',
                'contentOptions' =>['style' => 'white-space: nowrap'],
            ],
			'fulladdress',
        ],
    ]); 
// 	print_r($searchModel);
//     print_r($this);
// print_r(ArrayHelper::map(Sitestype::find()->select(['left(name, 3) AS sn', 'left(name, 3) AS sn'])->asArray()->where(['visible' => 1])->groupBy('sn')->orderBy(['sn' => SORT_ASC])->all(), 
//                     'sn',
// 					'sn'
// 					));
// echo Html::activeDropDownList(
//                     $searchModel, 
//                     'sitetype', 
//                     ArrayHelper::map(Sitestype::find()->select(['left(name, 3) AS sn', 'left(name, 3) AS sn'])->asArray()->where(['visible' => 1])->groupBy('sn')->orderBy(['sn' => SORT_ASC])->all(), 
//                     'sn',
// 					'sn'
// 					),
//                     [
//                         'class'=>'form-control',
//                         'prompt' => '',
// //                         'options' => ['RBS' => ['selected' => 'selected']]
//                     ]);
// print $oblid;

    ?>
</div>
