<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\address\StrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Улицы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="str-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<div class='row'>
		<div class='col-md-6'>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					// 'id',
					'name',

					['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>
		</div>	
	</div>		
</div>
