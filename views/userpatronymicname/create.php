<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Userpatronymicname */

$this->title = 'Create Userpatronymicname';
$this->params['breadcrumbs'][] = ['label' => 'Userpatronymicnames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userpatronymicname-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
