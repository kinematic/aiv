<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\people\Companies */

$this->title = 'Редактирование: ' . $model->simplename;
$this->params['breadcrumbs'][] = ['label' => 'Компании', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->simplename, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="companies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
