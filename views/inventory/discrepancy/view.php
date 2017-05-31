<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\inventory\Discrepancy */

$this->title = $model->catalog->codename;
$this->params['breadcrumbs'][] = ['label' => $model->sites->sitename, 'url' => ['sites/view', 'id' => $model->siteid, '#' => 'discrepancy']];
$this->params['breadcrumbs'][] = ['label' => 'Расхождения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discrepancy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'sites.sitename',
            'catalog.codename',
			'catalog.description',
            'partcount',
            'serialnumbers',
            'discrepancy',
            'description',
        ],
    ]) ?>

</div>
