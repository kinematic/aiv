<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\import\Mustang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mustangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mustang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'object',
            'planedaddress:ntext',
            'realaddress:ntext',
            'juricaladdress:ntext',
            'contacts',
            'startdate',
            'closedate',
            'mol',
            'status',
            'inventory',
            'lastinventorydate',
        ],
    ]) ?>

</div>
