<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Jobs;
use frontend\components\LeftMenuWidget;
use yii\widgets\LinkPager;


if(!empty($category)){
    $this->title = $category->meta_title;
    $this->params['breadcrumbs'][] = ['label' => 'Работа', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $category->title;
    $this->params['h1_title'] =  $category->title;
    
    $this->registerMetaTag(['itemprop' => 'keywords', 'name' => 'keywords', 'content' => $category->meta_keywords]);
    $this->registerMetaTag(['itemprop' => 'keywords', 'name' => 'description', 'content' => $category->meta_description]);

}else{
    $this->title = 'Веб фриланс - Бесплатный сервис web фриланса - Удаленная работа';
    $this->params['breadcrumbs'][] = 'Работа';
    $this->params['h1_title'] =  'Веб фриланс - Работа';
    $category['description'] = '<h2>Что такое веб фриланс</h2>
<p><img src="/img/freelancer.webp" alt="Что такое веб фриланс" width="150px" style="float:left;">Давайте сначала разберемся, кто такой фрилансер? Фрилансер - это самозанятый человек. В настоящем мире появилась отличная возможность зарабатывать деньги не выходя из дома, используя свои зания и навыки в области программирования или дизайна. Наша платформа разработана для помощи фрилансерам находить заказы по разработке сайтов on-line. Заказчик оставляет свой заказ на нашей бесплатной бирже фриланса, а исполнитель (фрилансер) делает отклик на заказ, тем самым рассказывает заказчику о своих возможностях и способностях.</p>
<h2>Фриланс для веб разработчиков</h2>
<p>Freetask.online- это фриланс биржа для начинающих бесплатно. Мы не берем плату за регистрацию и подачу заявок. У нас вы найдете лучший фриланс для веб разработчиков. В настоящее время популярные фриланс сервисы берут оплату за поднятие заявок или отклики веб мастеров. Мы предосталяем бесплатный фриланс сайт с всем необходимым функционалом для связи заказчика и фрилансера в поиске фриланс заказов.</p>';
    $this->registerMetaTag(['itemprop' => 'keywords', 'name' => 'keywords', 'content' => 'веб фриланс, Фриланс биржа заказы,']);
    $this->registerMetaTag(['itemprop' => 'description', 'name' => 'description', 'content' => 'Поручите ваш заказ лучшим фрилансерам на сайте «FreeTask» ✅ Новая платформа для Web-мастеров ✅ Полностью бесплатный фриланс ✅ Неограниченное количество заявок']);
}


?>
<section class="advance-search gray">
    <div class="container">
            <div class="row">

                    <div class="col-md-3 col-sm-12">
                            <div class="full-sidebar-wrap">
                                <?= LeftMenuWidget::widget(); ?>
                            </div>
                    </div>

                    <div class="col-md-9 col-sm-12">

                            <!--Filter 	-->						
                            <div class="row">
                                    <div class="col-md-12">
                                            <div class="filter-wraps" id="project-search">
                                                <?php echo Html::beginForm(['jobs/search', 'id' => Yii::$app->request->get('id')], 'GET') ?>
                                                    <div class="filter-wraps-one">
                                                        <input type="text" name="query" class="form-control" style="margin-bottom: 0;" placeholder="Найти работу" value="<?php if(isset($query)): echo $query; endif;?>">
                                                    </div>
                                                    <div class="filter-wraps-two">
                                                        <button class="btn btn-primary" type="submit">Поиск</button>
                                                    </div>
                                                <?php echo Html::endForm() ?>
                                            </div>
                                    </div>
                            </div>
                            <!--/.Filter -->
                            
                        <?php if(!empty($projects)):?>
                            <!--Browse Job -->							
                            <div class="row">
                                    <div class="col-md-12">

                                            <!-- Single New Job -->
                                            <?php foreach ($projects as $project) :?>
   
                                            <div class="newjob-list-layout">
                                                    <div class="cll-wrap">
                                                        <div class="cll-caption">
                                                            <h4><a href="<?= Url::to(['projects/view', 'url' => $project['url']]); ?>"><?php echo $project['title']?></a></h4>
                                                            <?php
                                                            $array = explode(" ", $project['description']);
                                                            $wordCount = count($array);
                                                            $array = array_slice($array, 0, 25);
                                                            $newtext = implode(" ", $array);
                                                            ?>
                                                            <p><a style="color:#667488" href="<?= Url::to(['projects/view', 'url' => $project['url']]); ?>"><?php echo $newtext?><?php if($wordCount>25): echo '...'; endif;?></a></p>
                                                            <ul>
                                                                <li><i class="fa fa-tags" aria-hidden="true"></i><a href="<?= Url::toRoute(['jobs/view', 'slug' => $project['category_url']])?>"><?php echo $project['cattitle']?></a></li>
                                                                <!--<li><a href="#">#Html</a></li>-->
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="cll-right">
                                                        <ul style="list-style: none;text-align: right;">
                                                            <li class="price_block">
                                                                <span class="service-response__price_success"><?= Html::encode($project['price']) ?> $</span>
                                                            </li>
                                                            <li><?php echo $project['responses']?> Заявки</li>
                                                            <li><span class="date time_ago" data-timestamp="<?php echo strtotime($project['create_date']);?>"><?php echo $project['create_date'];?></span></li>
                                                        </ul>
                                                    </div>
                                                <?php if($project['status']==0):?>
                                                <span class="tg-themetag tg-featuretag tg-green_label">Прием заявок</span>
                                                <?php elseif($project['status']==1):?>
                                                <span class="tg-themetag tg-featuretag tg-blue_label">Исполнитель определен</span>
                                                <?php elseif($project['status']==2):?>
                                                <span class="tg-themetag tg-featuretag tg-grey_label">Завершен</span>
                                                <?php endif;?>
                                            </div>
                                            <?php endforeach;?>
                                    </div>
                            </div>
                            <!--/.Browse Job-->

                            <div class="row mrg-0">
                               <?= LinkPager::widget(['pagination' => $pages]); /* постраничная навигация */ ?>
                            </div>
                            
                        <?php else:?>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="newjob-list-layout">
                                        <?php if(isset($query)):?>
                                        <h3 style="display:block;width:100%">По запросу <b><?=$query?></b> ничего не найдено.</h3>
                                        <?php else:?>
                                        <h3 style="display:block;width:100%">Ничего не найдено.</h3>
                                        <?php endif;?>
                                        <div>
                                            <?=
                                            Html::img(
                                                '@web/img/no_search.gif',
                                                ['alt' => '', 'class' => 'img-responsive']
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                            
                        <div class="row text-body">
                            <?php echo $category['description']?>
                        </div>
                    </div>

            </div>
    </div>
</section>
