<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\sites\Sitesforupdate */

$this->title = 'Update Sitesforupdate: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sitesforupdates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sitesforupdate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
