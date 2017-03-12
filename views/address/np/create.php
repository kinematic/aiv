<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\address\Np */

$this->title = 'Create Np';
$this->params['breadcrumbs'][] = ['label' => 'Nps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="np-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
