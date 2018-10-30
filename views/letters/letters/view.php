<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\letters\Letters */

$this->title = 'Письмо на проход на ' . $model->site->sitename;
// $this->params['breadcrumbs'][] = ['label' => 'Letters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->site->sitename, 'url' => ['sites/view', 'id' => $model->site->id]];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-view">

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
	<div style="width:50%; margin-left:50%">
	    <p><?= nl2br($model->appeal1) ?><br>
	    <?= $model->appeal2 ?></p>
	</div>
    <h3><center><?= $model->appeal3 ?></center></h3>
    <p style="text-indent: 1.5em"><?= $model->text1 . $model->site->fulladdress . $model->text2?></p>

	<div style="width:30%; margin-left:10%; float: left;">
	    <?= nl2br($model->signature->position) ?>
	</div>
	<div style="width:30%; margin-left:70%">
	    <?= nl2br($model->signature->chief->signature) ?>
	</div>

</div>
