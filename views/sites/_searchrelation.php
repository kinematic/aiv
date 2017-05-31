<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\inventory\DiscrepancySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['relations', 'id' => $model->id],
        'method' => 'get',
    ]); ?>
	<?php
	if(!$model->searchByNumber) $model->searchByNumber = $model->nr;
	?>
    <?= $form->field($model, 'searchByNumber') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
