<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\inventory\Discrepancy */

$this->title = 'Редактирование: ' . $model->sites->sitename;
$this->params['breadcrumbs'][] = ['label' => $model->sites->sitename, 'url' => ['sites/view', 'id' => $model->siteid]];
$this->params['breadcrumbs'][] = ['label' => 'Расхождения', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="discrepancy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
