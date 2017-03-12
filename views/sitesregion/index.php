<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SitesregionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sitesregions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sitesregion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sitesregion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'shortname',
            'description',
            'oblid',
            // 'import',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
