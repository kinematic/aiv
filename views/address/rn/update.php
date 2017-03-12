<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\address\Rn */

$this->title = 'Update Rn: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
