<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
// use app\assets\AppAsset;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */
// AppAsset::register($this);
?>

<?php $this->beginPage() ?>
    <?php $this->head() ?>
    <?php $this->beginBody() ?>
    <h2>This message allows you to visit our site home page by one click</h2>
    <?= Html::a('Go to home page', Url::home('http')) ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'sites.sitename',
            'catalog.codename',
            'serialnumbers',
            'partcount',
            'discrepancy',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php $this->endBody() ?>
<?php $this->endPage() ?>



