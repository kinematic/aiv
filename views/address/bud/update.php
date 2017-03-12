<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\address\Bud */

$this->title = 'Update Bud: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Buds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
