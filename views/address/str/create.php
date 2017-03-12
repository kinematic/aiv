<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\address\Str */

$this->title = 'Create Str';
$this->params['breadcrumbs'][] = ['label' => 'Strs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="str-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
