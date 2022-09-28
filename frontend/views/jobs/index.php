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
    
    $this->registerMetaTag(['name' => 'keywords', 'content' => $category->meta_keywords]);
    $this->registerMetaTag(['name' => 'description', 'content' => $category->meta_description]);
}else{
    $this->title = 'Работа для web мастеров - Бесплатный сервис web фриланса - Удаленная работа';
    $this->params['breadcrumbs'][] = 'Работа';
    
    $this->registerMetaTag(['name' => 'keywords', 'content' => 'HTML-верстка, веб-программирование, интернет-магазины, сайты под ключ, системы управления (CMS), тестирование сайтов, дизайн сайтов, администрирование сайтов, контент-менеджер, продвижение сайтов (SEO)']);
    $this->registerMetaTag(['name' => 'description', 'content' => 'Поручите ваш заказ лучшим фрилансерам на сайте «FreeTask» ✅ Новая платформа для Web-мастеров ✅ Полностью бесплатный фриланс ✅ Неограниченное количество заявок']);
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
                    </div>

            </div>
    </div>
</section>
