<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\inventory\Discrepancy */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => $model->sites->sitename, 'url' => ['sites/view', 'id' => $model->siteid]];;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discrepancy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
