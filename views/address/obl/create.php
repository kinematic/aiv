<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\address\Obl */

$this->title = 'Create Obl';
$this->params['breadcrumbs'][] = ['label' => 'Obls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
