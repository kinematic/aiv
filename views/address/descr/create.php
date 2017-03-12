<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\address\Descr */

$this->title = 'Create Descr';
$this->params['breadcrumbs'][] = ['label' => 'Descrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="descr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
