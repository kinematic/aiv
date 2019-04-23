<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\import\MustangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mustangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mustang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mustang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'object',
            'planedaddress:ntext',
            'realaddress:ntext',
            'juricaladdress:ntext',
            //'contacts',
            //'startdate',
            //'closedate',
            //'mol',
            //'status',
            //'inventory',
            //'lastinventorydate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
