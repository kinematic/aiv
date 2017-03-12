<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sitesregion */

$this->title = 'Update Sitesregion: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sitesregions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sitesregion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
