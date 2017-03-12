<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usersecondname */

$this->title = 'Update Usersecondname: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Usersecondnames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usersecondname-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
