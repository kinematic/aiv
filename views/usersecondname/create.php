<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usersecondname */

$this->title = 'Create Usersecondname';
$this->params['breadcrumbs'][] = ['label' => 'Usersecondnames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usersecondname-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
