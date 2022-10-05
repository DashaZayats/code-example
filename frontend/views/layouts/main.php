<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use frontend\components\TopMenuWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="icon" href="/favicon.ico">
    <title><?= Html::encode($this->title)?></title>

    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <div class="Loader"></div>
        <div class="wrapper">
            <nav class="navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full">
                <div class="container header-menu">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><i class="fa fa-bars"></i></button>
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl?>"><img width="200px" height="40px" src="/logo.png" class="logo logo-scrolled" alt=""></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class="active">
                                <?php echo Html::beginForm(['jobs/search', 'id' => Yii::$app->request->get('id')], 'GET') ?>
                                <input type="text" name="query" class="form-control" placeholder="Найти работу">
                                <?php echo Html::endForm() ?>
                            </li>
                            <li class="dropdown megamenu-fw">
                                <a href="<?= Url::to(['jobs/index']);?>" class="dropdown-toggle" data-toggle="dropdown">Работа</a>
                                <?= TopMenuWidget::widget() ?>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                            <?php if (Yii::$app->user->isGuest) : ?>
                                <li><a href="<?= Url::to(['site/signup']);?>"><i class="fa fa-pencil" aria-hidden="true"></i>Регистрация</a></li>
                                <li class="left-br"><a href="<?= Url::to(['site/login']);?>" class="signin">Вход</a></li>
                            <?php else:?>
                                <li><a href="<?= Url::to(['profile/index']);?>"><i class="fa fa-user" aria-hidden="true"></i>Профиль</a></li>
                                <li>
                                    <?php echo Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline left-br'])
                                   . Html::submitButton('Выйти (' . Yii::$app->user->identity->email . ')',
                                   ['class' => 'btn-link logout'])
                                   . Html::endForm();?>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="clearfix"></div>

            <section class="inner-header-title background-image">
                <div class="container">
                    <?php if(isset($this->params['h1_title'])):?>
                    <h1><?php echo $this->params['h1_title']?></h1>
                    <?php else:?>
                    <h1><?php echo $this->title?></h1>
                    <?php endif;?>
                </div>
            </section>
            <div class="clearfix"></div>
            <section class="gray" style="padding: 0;">
                <div class="container">
                    <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => 'Главная',
                        'url' => Yii::$app->homeUrl,
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                </div>
            </section>
            <div class="clearfix"></div>
            <?= $content ?>
            <div class="clearfix"></div>
            <footer class="dark-footer skin-dark-footer">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="footer-widget">
                                    <img src="/logo_footer.png" class="img-footer" alt="">
                                    <div class="footer-add">
                                        <p><strong>Email:</strong><br>freetask.online@gmail.com</p>
                                    </div>

                                </div>
                            </div>		
                            <div class="col-lg-3 col-md-3">
                                <div class="footer-widget">
                                    <h4 class="widget-title">Информация</h4>
                                    <ul class="footer-menu">
                                    <li>
                                        <a href="<?= Url::to(['site/about']); ?>">Как здесь все устроено?</a>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="footer-widget">
                                    <h4 class="widget-title">Пользователям</h4>
                                    <ul class="footer-menu">
                                       <!-- <li><a href="#">Тарифы</a></li>
                                        <li><a href="#">Задачи и теги</a></li>-->
                                        <li><a href="<?= Url::to(['jobs/index']); ?>">Фриланс заказы</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="footer-widget">
                                    <h4 class="widget-title">Помощь</h4>
                                    <ul class="footer-menu">
                                        <!--<li><a href="/index.php?r=site/contact">Помощь</a></li>
                                        <li><a href="#">Правила сервиса</a></li>-->
                                        <li><a href="<?= Url::to(['site/contact']);?>">Служба поддержки</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6">
                                <p class="mb-0">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
                            </div>
                            <div class="col-lg-6 col-md-6 text-right">
                                <!--
                                <ul class="footer-bottom-social">
                                    <li><a href="#"><i class="ti-facebook"></i></a></li>
                                    <li><a href="#"><i class="ti-twitter"></i></a></li>
                                    <li><a href="#"><i class="ti-instagram"></i></a></li>
                                    <li><a href="#"><i class="ti-linkedin"></i></a></li>
                                </ul>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
