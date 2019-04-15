<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'AIV2',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
			['label' => 'Люди', 'url' => ['/site/index'],
				'items' => [
					['label' => 'Пользователи', 'url' => ['people/users']],
					['label' => 'Люди', 'url' => ['people/people']],
					['label' => 'Имена', 'url' => ['people/secondname']],
					['label' => 'Отчества', 'url' => ['people/patronymicname']],
					['label' => 'Должности', 'url' => ['people/position']],
					['label' => 'Компании', 'url' => ['people/companies']],
				],
			],
			['label' => 'Объекты', 'url' => ['/site/index'],
				'items' => [
					['label' => 'Сайты', 'url' => ['sites/sites']],
					['label' => 'Типы сайтов', 'url' => ['sites/sitestype']],
					['label' => 'Регионы сайтов', 'url' => ['sites/sitesregion']],
				],
			],
			['label' => 'Адреса', 'url' => ['/site/index'],
				'items' => [
					['label' => 'Области', 'url' => ['address/obl']],
					['label' => 'Районы', 'url' => ['address/rn']],
					['label' => 'Типы населённых пунктов', 'url' => ['address/typenp']],
					['label' => 'Населённые пункты', 'url' => ['address/np']],
					['label' => 'Типы улиц', 'url' => ['address/typestr']],
					['label' => 'Улицы', 'url' => ['address/str']],
					['label' => 'Дома', 'url' => ['address/bud']],
					['label' => 'Название месности', 'url' => ['address/descr']],
					['label' => 'Описание', 'url' => ['address/comment']],
				],
			],
			['label' => 'Инвентаризация', 'url' => ['/site/index'],
				'items' => [
					['label' => 'Справочник оборудования', 'url' => ['inventory/catalog']],
					['label' => 'Расхождения', 'url' => ['inventory/discrepancy']],
				],
			],
			['label' => 'Письма', 'url' => ['/site/index'],
				'items' => [
					['label' => 'на проход', 'url' => ['letters/letters']],
					['label' => 'Подписи', 'url' => ['letters/signature']],
				],
			],
            // ['label' => 'Home', 'url' => ['/site/index']],
            // ['label' => 'About', 'url' => ['/site/about']],
            // ['label' => 'Contact', 'url' => ['/site/contact']],
            // Yii::$app->user->isGuest ? (
                // ['label' => 'Login', 'url' => ['/site/login']]
            // ) : (
                // '<li>'
                // . Html::beginForm(['/site/logout'], 'post')
                // . Html::submitButton(
                    // 'Logout (' . Yii::$app->user->identity->username . ')',
                    // ['class' => 'btn btn-link logout']
                // )
                // . Html::endForm()
                // . '</li>'
            // )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; AIV2 <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
