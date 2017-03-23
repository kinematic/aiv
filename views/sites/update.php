<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sites */

$this->title = $model->sitename;
$this->params['breadcrumbs'][] = ['label' => 'Сайты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sitename, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="sites-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<p><b>адрес из Мустанга:</b> <?= $model->mustangaddress?></p>
	<p><b>старое описание:</b> <?= $model->description?></p>
    <?= 
    $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
