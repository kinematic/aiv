<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sitestype */

$this->title = 'Update Sitestype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sitestypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sitestype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
