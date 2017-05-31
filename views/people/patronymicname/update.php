<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\people\Patronymicname */

$this->title = 'Update Patronymicname: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Patronymicnames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="patronymicname-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
