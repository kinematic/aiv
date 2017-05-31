<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => $site->sitename, 'url' => ['sites/view', 'id' => $site->id]];
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index', 'siteID' => $site->id]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="contacts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
