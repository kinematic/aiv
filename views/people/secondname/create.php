<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\people\Secondname */

$this->title = 'Create Secondname';
$this->params['breadcrumbs'][] = ['label' => 'Secondnames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="secondname-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
