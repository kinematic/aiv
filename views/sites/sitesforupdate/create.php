<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\sites\Sitesforupdate */

$this->title = 'Create Sitesforupdate';
$this->params['breadcrumbs'][] = ['label' => 'Sitesforupdates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sitesforupdate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
