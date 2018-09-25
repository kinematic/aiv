<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\sites\SitesforupdateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sitesforupdates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sitesforupdate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sitesforupdate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'planedaddress',
            'realaddress',
            'juricaladdress',
            // 'startdate',
            // 'closedate',
            // 'mol',
            // 'status',
            // 'isinventory',
            // 'lastinventorydate',
            // 'typeid',
            // 'regionid',
            // 'nr',
            // 'siteid',
            // 'statusid',
            // 'molid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
