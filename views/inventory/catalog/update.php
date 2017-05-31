<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\inventory\Catalog */

$this->title = 'Редактирование: ' . $model->codename;
$this->params['breadcrumbs'][] = ['label' => 'Справочник оборудования', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codename, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="catalog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
