<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\address\Rn */

$this->title = 'Create Rn';
$this->params['breadcrumbs'][] = ['label' => 'Rns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
