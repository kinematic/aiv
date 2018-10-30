<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
// use dosamigos\selectize\SelectizeDropDownList;
use yii2mod\selectize\Selectize;
use app\models\address\Obl;
use app\models\address\Rn;
use app\models\address\Typenp;
use app\models\address\Np;
use app\models\address\Typestr;
use app\models\address\Str;
use app\models\address\Bud;
use app\models\address\Descr;
use app\models\address\Comment;
use app\models\address\Gps;

/* @var $this yii\web\View */
/* @var $model app\models\Sites */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sites-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">    
    <?= $form->field($model, 'objid')->hiddenInput()->label(false);?>
    
	<div class="col-md-3">
		    <?php
		    if (isset($model->fullgps)) $model->gpsval = $model->fullgps; 
		    else $model->gpsval = NULL;
		    ?>
		    
		    <?= $form->field($model, 'gpsval')->textInput() ?>
	</div>
	<div class="col-md-3">
        <?= $form->field($model, 'relationid')->dropDownList(array(2 => 'на площадке RBS', 3 => 'на отдельной площадке')) ?>
	</div>
	<div class="col-md-2">
		<?php 
	    if (isset($model->typenp->id)) $model->typenpid = $model->typenp->id; 
	    else $model->typenpid = NULL;
	    ?>
	    
	    <?= $form->field($model, 'typenpid')->dropDownList(ArrayHelper::map(Typenp::find()->addOrderBy('name')->all(), 'id', 'name'), ['prompt'=>'']) ?>
		    
	</div>
	<div class="col-md-4">
		<?php
	    if (isset($model->np->id)) $model->npid = $model->np->id; 
	    else $model->npid = NULL;
	    $data = ArrayHelper::map(Np::find()->addOrderBy('name')->all(), 'id', 'name');
	    $data = array('' => '') + $data;
	    ?>
	    
	    <?= $form->field($model, 'npid')->widget(Selectize::className(), [
	            'items' => $data,
	            'pluginOptions' => [
	                'persist' => false,
	                'createOnBlur' => true,
	                'create' => true
	            ]
	    ]); ?>
    </div>
</div>
<div class="row">
	<div class="col-md-3">
		<?php 
	    if (isset($model->obl->id)) $model->oblid = $model->obl->id;
	    else $model->oblid = '';
	    $data = ArrayHelper::map(Obl::find()->addOrderBy('name')->all(), 'id', 'name');
	    $data = array('' => '') + $data;
	    
	    echo $form->field($model, 'oblid')->widget(Selectize::className(), [
	            'items' => $data,
	            'pluginOptions' => [
	                'persist' => false,
	                'createOnBlur' => false,
	                'create' => true,
	                'allowEmptyOption' => true,
	            ]
	    ]); ?>
	</div>
	<div class="col-md-3">
        <?php 
	    if (isset($model->rn->id)) $model->rnid = $model->rn->id;
	    else $model->rnid = NULL; 
	    $data = ArrayHelper::map(Rn::find()->addOrderBy('name')->all(), 'id', 'name');
	    $data = array('' => '') + $data;
	    ?>
	    
	    <?= $form->field($model, 'rnid')->widget(Selectize::className(), [
	            'items' => $data,
	            'pluginOptions' => [
	                'persist' => false,
	                'createOnBlur' => true,
	                'create' => true
	            ]
	    ]); ?>
	</div>
	<div class="col-md-2">
		<?php 
	    if (isset($model->typestr->id)) $model->typestrid = $model->typestr->id; 
	    else $model->typestrid = NULL;
	    ?>
	    
	    <?= $form->field($model, 'typestrid')->dropDownList(ArrayHelper::map(Typestr::find()->addOrderBy('name')->all(), 'id', 'name'), ['prompt'=>'']) ?>
	    
	</div>
	<div class="col-md-4">
		<?php
	    if (isset($model->str->id)) $model->strid = $model->str->id; 
	    else $model->strid = NULL;
	    $data = ArrayHelper::map(Str::find()->addOrderBy('name')->all(), 'id', 'name');
	    $data = array('' => '') + $data;
	    ?>
	    
	    <?= $form->field($model, 'strid')->widget(Selectize::className(), [
	            'items' => $data,
	            'pluginOptions' => [
	                'persist' => false,
	                'createOnBlur' => true,
	                'create' => true
	            ]
	    ]); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		
	</div>
	<div class="col-md-1">
		<?php
		if (isset($model->bud->value)) $model->budval = $model->bud->value; 
		else $model->budval = NULL;
		?>
		<?= $form->field($model, 'budval')->textInput() ?>
	</div>
	<div class="col-md-5">
		<?php 
	    if(isset($model->descr->value)) $model->descrval = $model->descr->value;
	    else $model->descrval = NULL;
	    ?>
	    
	    <?= $form->field($model, 'descrval')->textInput() ?>
	</div>
</div>

	<div class="row">
    
	    
	    
	    <?php
	    if (isset($model->comment->value)) $model->commentval = $model->comment->value; 
	    else $model->commentval = NULL;
	    ?>
	    
	    <?= $form->field($model, 'commentval')->textarea(['rows' => 6]) ?>

    </div>

</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
	<p><b>адрес из Мустанга:</b> <?= $model->mustangaddress?></p>
	<?php if(isset($model->description)) print '<p><b>старое описание:</b> ' . $model->description ?>
	

</div>

<?php //var_dump($model);?>
