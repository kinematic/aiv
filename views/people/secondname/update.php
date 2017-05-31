<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\people\Secondname */

$this->title = 'Update Secondname: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Secondnames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="secondname-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
