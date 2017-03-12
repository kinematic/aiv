<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\address\Typenp */

$this->title = 'Create Typenp';
$this->params['breadcrumbs'][] = ['label' => 'Typenps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="typenp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
