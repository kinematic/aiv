<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\letters\ListsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lists-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lists', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'letterid',
            'manid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
