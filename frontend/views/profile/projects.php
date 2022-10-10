<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use frontend\components\ProfileMenuWidget;
use frontend\components\ProjectStageWidget;
use yii\widgets\ActiveForm;
use app\models\Projects;

$this->title = 'Мои проекты';
$this->params['breadcrumbs'][] = ['label' => 'Панель управления', 'url'=>Url::toRoute('/profile')];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="advance-search gray">
    <div class="container">
            <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="full-sidebar-wrap">
                            <?= ProfileMenuWidget::widget(); ?>
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-12">

                        <?php if(!empty($projects)):?>
                            <!--Browse Job -->							
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Single New Job -->
                                    <?php foreach ($projects as $project) :?>

                                    <div class="newjob-list-layout">
                                            <div class="cll-wrap">
                                                    <div class="cll-caption">
                     
                                                            <h4><a href="<?= Url::to(['profile/project', 'id' => $project['id']]); ?>"><?php echo $project['title']?></a></h4>
                                                            <?php
                                                            $array = explode(" ", $project['description']);
                                                            $wordCount = count($array);
                                                            $array = array_slice($array, 0, 25);
                                                            $newtext = implode(" ", $array);
                                                            ?>
                                                            <p><a style="color:#667488" href="<?= Url::to(['profile/project', 'id' => $project['id']]); ?>"><?php echo $newtext?><?php if($wordCount>25): echo '...'; endif;?></a></p>
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
                                        <?php
                                          $model = Projects::findOne(['id' => $project['id']]);
                                        ?>
                                        <?php if($project['status']==0):?>
                                        <span class="tg-themetag tg-featuretag tg-green_label">Прием заявок</span>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="brows-job-link">
                                                <a href="<?= Url::to(['profile/project', 'id' => $project['id']]); ?>" class="btn btn-warning">Выбрать исполнителя</a>
                                            </div>
                                            
                                            <!-- Кнопка завершить с модальным окном -->
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#responses<?php echo $project['id']?>" class="btn btn-dark close_project">Завершить</a>
                                            <div class="modal fade in" id="responses<?php echo $project['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="false" style="display: none">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <?= $this->render('../projects/_form_close', [
                                                                'model' => new Projects, 
                                                                'project_id' => $project['id'],
                                                                'project_title' => $project['title'],
                                                                'from_user_id' => $project['created_by_id'],
                                                                'user_id' => $project['worker_id'],
                                                                'worker_email' => $project['worker_email'],
                                                                'worker_imageFile' =>$project['worker_imageFile'],
                                                           ]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Кнопка завершить с модальным окном конец-->
                                            
                                        </div>
                                        <?php elseif($project['status']==1):?>
                                        <span class="tg-themetag tg-featuretag tg-orange_label">Выполнение заказа</span>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="brows-job-link">
                                            <!-- Кнопка завершить с модальным окном -->
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#responses<?php echo $project['id']?>" class="btn btn-dark close_project">Завершить</a>
                                            <div class="modal fade in" id="responses<?php echo $project['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="false" style="display: none">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                          
                                                            <?= $this->render('../projects/_form_close', [
                                                                'model' => new Projects, 
                                                                'project_id' => $project['id'],
                                                                'project_title' => $project['title'],
                                                                'from_user_id' => $project['created_by_id'],
                                                                'user_id' => $project['worker_id'],
                                                                'worker_email' => $project['worker_email'],
                                                                'worker_imageFile' =>$project['worker_imageFile'],
                                                           ]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Кнопка завершить с модальным окном конец-->
                                            </div>
                                        </div>
                                        <?php elseif($project['status']==2):?>
                                        <span class="tg-themetag tg-featuretag tg-grey_label">Завершен</span>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="brows-job-link">
                                                <a href="<?= Url::to(['profile/project', 'id' => $project['id']]); ?>" class="btn btn-primary">Просмотр</a>
                                            </div>
                                        </div>
                                        <?php endif;?>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <!--/.Browse Job-->

                            <div class="row mrg-0">
                               <?= LinkPager::widget(['pagination' => $pages]); /* постраничная навигация */ ?>
                            </div>
                        <?= ProjectStageWidget::widget(); ?>
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