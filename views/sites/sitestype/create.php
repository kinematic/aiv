<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sitestype */

$this->title = 'Create Sitestype';
$this->params['breadcrumbs'][] = ['label' => 'Sitestypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sitestype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
