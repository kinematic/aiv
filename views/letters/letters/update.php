<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\letters\Letters */

$this->title = 'Редактирование письма на проход на ' . $model->site->sitename;
// $this->params['breadcrumbs'][] = ['label' => 'Письма', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->site->sitename, 'url' => ['sites/view', 'id' => $model->site->id]];
$this->params['breadcrumbs'][] = ['label' => 'Письмо на проход на ' . $model->site->sitename, 'url' => ['letters/letters/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="letters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'people' => $people,
    ]) ?>

</div>
