<?php
use yii\helpers\Url;
/** @var yii\web\View $this */

$this->title = 'Биржа фриланса Freetask — Удаленная работа. Фриланс работа и вакансии, фрилансер, работа на дому.';
$this->registerMetaTag(['name' => 'keywords', 'content' => 'HTML-верстка , Веб-программирование, Интернет-магазины , Сайты «под ключ» , Системы управления (CMS) , Тестирование сайтов , Дизайн сайтов, Администрирование сайтов , Контент-менеджер ,Продвижение сайтов (SEO) ']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Фриланс заказы для web программистов, верстальщиков, дизайнеров, сеошников, тестировщиров, администраторов, контент менеджеров']);
?>
<div class="clearfix"></div>
<section class="call-to-act">
    <div class="container" style="width:100%;padding:0">
        <div class="col-md-6 col-sm-6 no-padd bl-dark">
            <div class="call-to-act-caption">
                <h2>Фрилансерам</h2>
                <h3>Ищите работу<br> Смотрите открытые проекты</h3>
                <a href="<?= Url::to(['jobs/index']); ?>" class="btn bat-call-to-act">Найти работу</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 no-padd gr-dark">
            <div class="call-to-act-caption">
                <h2>Заказчикам</h2>
                <h3>Создайте фриланс проект <br>Получите лучшие предложения от фрилансеров</h3>
                <a href="<?= Url::to(['projects/create']); ?>" class="btn bat-call-to-act">Разместить заказ</a>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<?php if(!empty($jobs)):?>
    <section class="grey">
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    <h2>Заказы по <span>Категориям</span></h2></div>
            </div>
            <div class="row">
                <?php foreach($jobs as $category):?>
                <div class="col-md-3 col-sm-3">
                    <div class="category-box" data-aos="fade-up">
                        <div class="category-desc">
                            <div class="category-detail category-desc-text">
                                <h4> <a href="<?= Url::to(['jobs/view', 'slug' => $category['url']]); ?>"><?php echo $category['title']?></a></h4>
                                <p><?php echo $category['projectCount']?> предложений</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
<?php endif;?>
<?php if (Yii::$app->user->isGuest) : ?>
    <section class="theme-bg call-to-act-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="call-to-act">
                        <div class="call-to-act-head">
                            <h3>Хотите стать успешным работодателем?</h3>
                            <span>Мы поможем вам в карьерном росте.</span>
                        </div>
                        <a href="<?= Url::to(['site/signup']);?>" class="btn btn-call-to-act">Зарегистрироваться</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
<?php endif;?>