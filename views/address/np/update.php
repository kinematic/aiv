<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\address\Np */

$this->title = 'Update Np: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="np-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
