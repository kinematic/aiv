<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\inventory\DiscrepancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расхождения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discrepancy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
            $tmp = Yii::$app->request->queryParams;
            if(isset($tmp['DiscrepancySearch']['siteid'])) {
            $siteID = $tmp['DiscrepancySearch']['siteid'];

            if(isset($siteID)) echo Html::a('Отправить письмо', ['mailer', 'DiscrepancySearch[siteid]' => $siteID], ['class' => 'btn btn-primary']); 
        } ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'sites.sitename',
            'codename',
            'partcount',
//             'discrepancy',
            [
                'attribute' => 'discrepancyid',
                'value' => 'discrepancy',
                'filter' => array('1' => 'недостача', '2' => 'излишек'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
//     $tmp = Yii::$app->request->queryParams;
//     print $tmp['DiscrepancySearch']['siteID'];
//     
//     print_r (Yii::$app->request->queryParams);
    ?>
</div>
