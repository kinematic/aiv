<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = 'Создание';
$this->params['breadcrumbs'][] = ['label' => $site->sitename, 'url' => ['sites/view', 'id' => $site->id]];
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index', 'siteID' => $site->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'site' => $site,
    ]) ?>

</div>
