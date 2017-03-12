<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\address\Bud */

$this->title = 'Create Bud';
$this->params['breadcrumbs'][] = ['label' => 'Buds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
