<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\letters\LettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Letters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Letters', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'objid',
            'appeal1',
            'appeal2',
            'appeal3',
            // 'firstname',
            // 'secondnameid',
            // 'patronymicnameid',
            // 'signid',
            // 'text1:ntext',
            // 'text2:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
